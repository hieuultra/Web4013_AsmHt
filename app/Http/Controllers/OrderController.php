<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $Bills = Auth::user()->bills()->orderBy('created_at', 'desc')->get();  //tro den class bilss ben model user

        $statusBill = Bills::status_bill;

        $type_cho_xac_nhan = Bills::CHO_XAC_NHAN;
        $type_dang_van_chuyen = Bills::DANG_VAN_CHUYEN;

        return view('client.orders.index', compact('categories', 'Bills', 'statusBill', 'type_cho_xac_nhan', 'type_dang_van_chuyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $carts = session()->get('cart', []);
        if (!empty($carts)) {
            $total = 0;
            $subtotal = 0;
            foreach ($carts as $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }
            $shipping = 50;
            $total = $subtotal + $shipping;
            return view('client.orders.create', compact('categories', 'carts', 'total', 'shipping', 'subtotal'));
        }
        return redirect()->route('cart.listCart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        if ($request->isMethod('POST')) {
            DB::beginTransaction();
            try {
                // Lấy dữ liệu từ request
                $params = $request->except('_token');
                $bill = Bills::query()->create($params);
                $billId = $bill->id;

                $carts = session()->get('cart', []);

                foreach ($carts as $key => $item) {
                    // Kiểm tra số lượng tồn kho trước khi tạo đơn hàng
                    $product = Product::findOrFail($key);
                    if ($product->quantity < $item['quantity']) {
                        DB::rollBack();
                        return redirect()->route('cart.listCart')->with('error', 'Not enough stock for product ' . $product->name);
                    }
                    // Tạo chi tiết đơn hàng
                    $tt = $item['price'] * $item['quantity'];
                    $bill->order_detail()->create([
                        'bills_id' => $billId,
                        'product_id' => $key,
                        'donGia' => $item['price'],
                        'quantity' => $item['quantity'],
                        'thanhTien' => $tt
                    ]);
                    // Giảm số lượng sản phẩm trong kho
                    $product->quantity -= $item['quantity'];
                    $product->save();

                }
                DB::commit();

                //khi add thanh cong se thuc hien cac cv ben duoi
                //tru di so luong cua san pham khi add thanh cong

                //gui mail khi dat hang tc
                Mail::to($bill->emailUser)->queue(new OrderConfirmationMail($bill));

                session()->put('cart', []);
                return redirect()->route('orders.index')->with('success', 'Bill have created successfully');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.listCart')->with('error', 'Order failed');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $bill = Bills::query()->findOrFail($id);
        $statusBill = Bills::status_bill;
        $status_payment_method = Bills::status_payment_method;
        return view('client.orders.show', compact('bill', 'statusBill', 'status_payment_method', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bills::query()->findOrFail($id);
        DB::beginTransaction();

        try {
            if ($request->has('da_huy')) {
                $bill->update(['status_bill' => Bills::DA_HUY]);
                // Hoàn lại số lượng sản phẩm về kho
                foreach ($bill->order_detail as $orderDetail) {
                    $product = Product::findOrFail($orderDetail->product_id);
                    $product->quantity += $orderDetail->quantity;
                    $product->save();
                }
            } elseif ($request->has('da_giao_hang')) {
                $bill->update(['status_bill' => Bills::DA_GIAO_HANG]);
            }
            //Sử dụng DB::commit() để xác nhận thay đổi nếu mọi thứ thành công.
            //Nếu có lỗi, sử dụng DB::rollBack() để hoàn tác tất cả các thay đổi.
            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Bill updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.index')->with('error', 'Bill update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
