<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Invoice;
use Stripe\Product;
use Stripe\Customer;
use Stripe\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionItem;
use App\Models\Plan as ModelsPlan;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscription as ModelsSubscription;
use Illuminate\Support\Str;


class PlanController extends Controller
{
    public function index()
    {
        $plans = ModelsPlan::get();
        $plan_count = ModelsPlan::count();
        return view("admin.plans.index", compact('plans', 'plan_count'));
    }

    public function create()
    {

        return view('admin.plans.create');
    }
    public function planStatus(Request $request)
    {
        $ModelsPlan = ModelsPlan::where('id', $request->plan_id)->first();
        $ModelsPlan->status = $request->status;
        $ModelsPlan->update();
        return response()->json([
            'success' => true,
            'message' => "Plan status updated"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEN' => ['required', 'max:255'],
            'nameAR' => ['required', 'max:255'],
            'price' => ['required', 'max:5000'],
            'daily_transfer_amount' => ['required', 'max:5000'],
            'currency' => ['required', 'max:255'],
            'duration' => ['required', 'max:255'],
            'descriptionEN' => ['required', 'string','alpha', 'max:500'],
            'descriptionAR' => ['required', 'string','alpha', 'max:500'],
        ]);

        ModelsPlan::create([
            'nameEN' => $request->nameEN,
            'nameAR' => $request->nameAR,
            'price' => $request->price,
            'daily_transfer_amount' => $request->daily_transfer_amount,
            'duration' => $request->duration,
            'currency' => $request->currency,
            'descriptionEN' => $request->descriptionEN,
            'descriptionAR' => $request->descriptionAR,
            'slug' => Str::slug($request->name, '_')
        ]);
        session()->flash('alert_success', 'Plan Created Successfully');
        return redirect()->route('plan.index');
    }
    public function edit($id)
    {

        $modelPlan = ModelsPlan::where('id', $id)->first();
        return view('admin.plans.edit', compact('modelPlan'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nameEN' => ['required', 'max:255'],
            'nameAR' => ['required', 'max:255'],
            'price' => ['required', 'max:5000'],
            'daily_transfer_amount' => ['required', 'max:5000'],
            'currency' => ['required', 'max:255'],
            'duration' => ['required', 'max:255'],
            'descriptionEN' => ['required', 'string','alpha', 'max:500'],
            'descriptionAR' => ['required', 'string','alpha', 'max:500'],
        ]);
        $modelPlan = ModelsPlan::where('id', $id)->first();
        $modelPlan->nameEN = $request->nameEN;
        $modelPlan->nameAR = $request->nameAR;
        $modelPlan->price = $request->price;
        $modelPlan->daily_transfer_amount = $request->daily_transfer_amount;
        $modelPlan->duration = $request->duration;
        $modelPlan->currency = $request->currency;
        $modelPlan->descriptionEN = $request->descriptionEN;
        $modelPlan->descriptionAR = $request->descriptionAR;
        $modelPlan->save();
        session()->flash('alert_success', 'Plan Updated Successfully');
        return redirect()->route('plan.index');
    }
    public function destroy($id)
    {
        $modalPlan = ModelsPlan::where('id', $id)->first();
        $modalPlan->delete();

        session()->flash('alert_success', 'Plan Deleted Successfully');
        return redirect()->back();
    }
/**
* Write code on Method
*
* @return response()
*/
public function show($id)
{
    $plan = ModelsPlan::where('id', $id)->first();
    return view("admin.plans.subscription", compact("plan"));
}
/**
* Write code on Method
*
* @return response()
*/
public function subscription(Request $request)
{
    $validator = Validator::make($request->all(), [
        'card_number' => ['required'],
        'exp_month' => ['required'],
        'exp_year' => ['required'],
        'cvc' => ['required'],
    ]);
    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors()
        ];
        return response()->json($response, 400);
    }
    $plan_id = auth()->user()->plan_id;

    if (empty($plan_id)) {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $paymentMethod = \Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $request->card_number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
            $token = $paymentMethod->id;
            $request['token'] = $token;

            $plan = ModelsPlan::find($request->plan);
            $user = auth()->user();
            $user->plan_id = $plan->id;
            $user->update();
            $subscription_details = $request->user()->newSubscription($request->plan, $plan->plan_id)->create($request->token);

            $subscription = Subscription::retrieve($subscription_details->stripe_id);

            $endDate = date('Y-m-d H:i:s', $subscription->current_period_end);
            $subscriptionM = ModelsSubscription::where('user_id', auth()->user()->id)->where('stripe_price', $plan->plan_id)->where('stripe_status', 'active')->first();
            $subscriptionM->trial_ends_at = $endDate;
            $subscriptionM->update();
            $invoice = Invoice::retrieve($subscription->latest_invoice);
            $response = [
                'payment_invoice' => $invoice->invoice_pdf,
                'message' => 'You have Subscribed to ' . $subscription->items->data[0]->plan->nickname . " Plan successfully",
                'status' => '200',
            ];
            return response()->json($response);
        } catch (ApiErrorException $e) {
// Handle error
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    } else {
        $plan = ModelsPlan::where('id', $plan_id)->first();
        $message = "You have Already Subscribed to " . $plan->name . "Please Unsubscribe it first";
        $response = [
            'message' => $message,
            'status' => 400,
        ];
        return $response;
    }
}

public function cancelSubscription(Request $request)
{

    Stripe::setApiKey(env('STRIPE_SECRET'));


    $plan = ModelsPlan::where('id', $request->plan_id)->first();

    $subscription = ModelsSubscription::where('user_id', auth()->user()->id)->where('stripe_price', $plan->plan_id)->where('stripe_status', 'active')->first();

    try {
        $subscriptionC = Subscription::retrieve($subscription->stripe_id);
// $stripe = new \Stripe\StripeClient('sk_test_51N14EcFIA5AfSO7meh2YLiMQvQNBAon0rgPaEfSmDsxCBubkP4Wipg2Ou7bX63WE0AD4NO7xdsU0CnBX9HkRf0mV00Zu2mmfvw');
// $latest_invoice_id = $subscriptionC->latest_invoice;
// $latest_invoice = Invoice::retrieve($latest_invoice_id);
// $charge_id = $latest_invoice->charge;

// $refund =$stripe->refunds->create([
//     'charge' => $charge_id,
//     'amount' => 10*100,
// ]);
        $user = auth()->user();
        $user->plan_id = "";
        $user->update();
        $subscriptionC->cancel();
        $subscription->stripe_status = 'deactivated';
        $subscription->update();

        return response()->json([
            'message' => "Your subscription have been cancelled Successfully",
            'status' => '200',
        ], 200);
    } catch (ApiErrorException $e) {
// Handle error
        return response()->json([
            'error' => $e->getMessage(),
        ], 400);
    }
}

/**
* @OA\get(
* path="/api/getAllPlans",
* operationId="getAllPlans",
* security={{"bearerAuth": {}}},
* tags={"Get All Subscription Plans"},
* summary="User will see all subscription plans",
* description="User will get all subscription plans",
*      @OA\Response(
*          response=200,
*          description=" User will see all services subscription plans",
*          @OA\JsonContent()
*       ),
*      @OA\Response(
*          response=400,
*          description="Bad request",
*          @OA\JsonContent()
*       ),
*      @OA\Response(response=404, description="Resource Not Found"),
* )
*/

public function getAllPlans()
{

    Stripe::setApiKey(env('STRIPE_SECRET'));

    $plans = ModelsPlan::where('status', 1)->get();

    $data = [];
    foreach ($plans as $plan) {
        $data[] = [
            'plan_id' => $plan->plan_id,
            'name' => $plan->name,
            'product' => $plan->product_id,
            'price' => $plan->price / 100,
            'discount' => $plan->discount,
            'billing_period' => $plan->billing_period,
            'currency' => $plan->currency,
            'description' => $plan->description,
        ];
    }

    return response()->json([
        'data' => $data,
        'status' => 200,
        'message' => "got all plans successfully",
    ]);
}

public function changeSubscription(Request $request)
{

    $validator = Validator::make($request->all(), [
        'new_plan_id' => ['required'],
    ]);
    if ($validator->fails()) {
        $response = [
            'success' => false,
            'message' => $validator->errors()
        ];
        return response()->json($response, 400);
    }
    Stripe::setApiKey(env('STRIPE_SECRET'));
    $user = auth()->user();
    $old_plan = ModelsPlan::where('id', $user->plan_id)->first();
    $new_plan = ModelsPlan::where('id', $request->new_plan_id)->first();

    try {
        $subscriptionM = ModelsSubscription::where('user_id', auth()->user()->id)->where('stripe_price', $old_plan->plan_id)->where('stripe_status', 'active')->first();
        $subscription = Subscription::retrieve($subscriptionM->stripe_id);
        $customer = Customer::retrieve(auth()->user()->stripe_id);
        $plan = Plan::retrieve($new_plan->plan_id);
        $oldPlan = Plan::retrieve($old_plan->plan_id);
        $subscription->plan = $plan;
        if ($plan->amount > $oldPlan->amount) {
            $subscription->default_payment_method = $customer->default_payment_method;
            $subscription->billing_cycle_anchor = 'now';
        }
        $subscription->save();
        $user = auth()->user();
        $user->plan_id = $new_plan->id;
        $user->update();
        $subscriptionM->name = $new_plan->id;
        $subscriptionM->stripe_price = $new_plan->plan_id;
        $subscriptionM->quantity = $subscription->quantity;
        $endDate = date('Y-m-d H:i:s', $subscription->current_period_end);
        $subscriptionM->trial_ends_at = $endDate;
        $subscriptionM->update();
        $subscriptionItems = SubscriptionItem::where('subscription_id', $subscriptionM->id)->first();
        $subscriptionItems->stripe_product = $subscription->plan->product;
        $subscriptionItems->stripe_price = $new_plan->plan_id;
        $subscriptionItems->quantity = $subscription->items->data[0]->quantity;
        $subscriptionItems->update();
        $invoice = Invoice::retrieve($subscription->latest_invoice);
        $response = [
            'payment_invoice' => $invoice->invoice_pdf,
            'message' => 'You have Subscribed to ' . $subscription->items->data[0]->plan->nickname . " Plan successfully",
            'status' => '200',
        ];
        return response()->json($response);
    } catch (ApiErrorException $e) {
// Handle error
        return response()->json([
            'error' => $e->getMessage(),
        ], 400);
    }
}
}
