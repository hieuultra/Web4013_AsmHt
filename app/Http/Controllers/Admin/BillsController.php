<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBills = Bills::query()->orderByDesc('id')->get();
        $statusBill = Bills::status_bill;

        $type_da_huy = Bills::DA_HUY;
        return view('admin.bills.index', compact('listBills', 'statusBill', 'type_da_huy'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bill = Bills::query()->findOrFail($id);
        $statusBill = Bills::status_bill;
        $statusPaymentMethod = Bills::status_payment_method;
        return view('admin.bills.show', compact('bill', 'statusBill', 'statusPaymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bills::query()->findOrFail($id);

        $currentStatus = $bill->status_bill;

        $newStatus = $request->input('status_bill');

        $status = array_keys(Bills::status_bill);

        //kiem tra neu bill da huy thi ko dc change status
        if ($currentStatus === Bills::DA_HUY) {
            return redirect()->route('admin.bills.index')->with('error', 'Bills had unset can not change status');
        }
        //kiem tra neu status moi ko dc nam sau status hien tai
        if (array_search($newStatus, $status) < array_search($currentStatus, $status)) {
            return redirect()->route('admin.bills.index')->with('error', 'New Status must be after current status');
        }

        $bill->status_bill = $newStatus;
        $bill->save();
        return redirect()->route('admin.bills.index')->with('success', 'Status bill has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bills::query()->findOrFail($id);
        if ($bill && $bill->status_bill == Bills::DA_HUY) {
            $bill->order_detail()->delete();
            $bill->delete();
            return redirect()->back()->with('success', 'Delete bill successfully');
        }
        return redirect()->back()->with('error', 'Can Not Delete Bill');
    }
}
