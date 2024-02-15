<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Cart::count() > 0)
            return view('payment.checkout');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->address = $request->address;
        $customer->province = $request->province;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->note = $request->note;
        $customer->save();
        $order = new Order();
        $order->code = rand(111111, 999999);
        $order->customer_id = $customer->id;
        $order->order_date = date("Y-m-d");
        $order->total = Cart::total(0, "", "");;
        $order->subtotal = Cart::subtotal(0, "", "");;
        $order->status = 0;
        $order->payment = $request->payment;
        $order->save();
        foreach (Cart::content() as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item->id;
            $order_detail->qty = $item->qty;
            $order_detail->price = $item->price;
            $order_detail->save();
        }
        // Gửi mail mua hàng
        try {
            $fullname = $request->last_name . ' ' . $request->first_name;
            Mail::send('email.order', ['name' => $fullname, 'email' => $request->email, 'phone' => $request->phone, 'address' => $request->address], function ($message) use ($request) {
                //$message->from('john@johndoe.com', 'John Doe');
                //$message->sender('john@johndoe.com', 'John Doe');
                $message->to($request->email, $request->first_name);
                //$message->cc('john@johndoe.com', 'John Doe');
                $message->bcc('nguyenphuochao456@gmail.com', 'Hao Nguyen');
                //$message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Thông tin hóa đơn mua hàng');
                //$message->priority(3);
                //$message->attach('pathToFile');
            });
        } catch (\Throwable $e) {
            // return redirect()->back()->with(['mess' => $e->getMessage(), 'type' => 'danger']);
            dd($e->getMessage());
        }
        Cart::destroy();
        return redirect()->route('fe.order-received');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function order_received()
    {
        return view('payment.order_received');
    }
    public function buy_now(Request $request)
    {
        $customer = new Customer();
        $customer->fullname = $request->fullname;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->note = $request->note;
        $customer->save();

        $order = new Order();
        $order->code = rand(111111, 999999);
        $order->customer_id = $customer->id;
        $order->order_date = date("Y-m-d");
        $order->total = $request->price * $request->qty;
        $order->subtotal = $request->price * $request->qty;
        $order->status = 0;
        $order->payment = "Chờ xác thức phương thức thanh toán";
        $order->save();

        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->product_id = $request->product_id;
        $order_detail->qty = $request->qty;
        $order_detail->price = $request->price;
        $order_detail->save();
        return response()->json(['mess' => 'Đặt hàng nhanh thành công']);
    }
    public function ordered(Request $request)
    {
        $qty = $request->qty;
        $price = $request->price;
        $subtototal = number_format($qty * $price);
        echo $subtototal;
    }
}
