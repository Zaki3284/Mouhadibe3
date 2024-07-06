<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Mail\ProductNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class OrderController extends Controller
{
    public function showOrders()
    {
        $orders = Order::with('product')->get();
        return view('orders.index', compact('orders'));
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'message' => $request->message,
            'status' => 'no',
        ]);

        return response()->json(['success' => true, 'order' => $order]);
    }

    public function markAsComplete(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'yes';
        $order->save();

        return redirect()->back()->with('success', 'Order marked as complete.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function notifyFournisseurs($productId)
    {
        // Fetch admin user ID (assuming the admin role is 'Admin')
        $admin = Role::findByName('Admin')->users->first();
        $adminId = $admin->id;

        // Fetch users with role 'Fournisseur' who have the same product in their orders
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Fournisseur');
        })->whereHas('orders', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })->get();

        $product = Product::findOrFail($productId);
        $info = "هناك تحديث بخصوص المنتج: {$product->name}.";
        $messageContent = "يرجى التحقق من التفاصيل المحدثة للمنتج.";

        foreach ($users as $user) {
            Mail::to($user->email)->send(new ProductNotificationMail($adminId, $info, $messageContent));
        }

        return response()->json(['success' => true, 'message' => 'Notifications sent.']);
    }
}
