<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Message;

class ApiController extends Controller
{
        // POST
        // /register
        # Handles registering a brand new user
        public function register(Request $request) {
            // ['user_id', 'email', 'first_name', 'last_name', 'password'];
            $user = new User;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->save();

            $resp = [ "user_id" => $user->user_id, "email" => $user->email, "first_name" => $user->first_name, "last_name" => $user->last_name];

            return response()->json($resp, 201);
          }

        // POST
        // /login
        # Handles a login request from the user. If the login was unsuccessful, you must send an appropriate error response.
      public function login(Request $request) {
        # You could also use ->first() instead of ->get() on the query builder which will return an instance of the first found model, or null otherwise.
        $users = DB::table('users')->get();
        $user = NULL;

        foreach ($users as $value) {
            if ($value->email == $request->email && $value->password == $request->password) {
                $user = $value;
            }
        }

        // $user = DB::table('users')->where($request->email, $request->password)->first();

        $resp = NULL;
        $statusCode = NULL;

        if (!$request->has('email') || !$request->has('password') || is_null($request)) {
            # Set HTTP status code to Bad Request for invalid credentials
            $statusCode = http_response_code(400);
            $resp = [ "error_code" => $statusCode, "error_title" => "Login Failure", "error_message" => "Email or Password was Invalid!"];
        } else {
            $resp = [ "user_id" => $user->user_id, "email" => $user->email, "first_name" => $user->first_name, "last_name" => $user->last_name];
            # Set HTTP status code to Success for valid credentials
            $statusCode = http_response_code(200);
        }

        return response()->json($resp, $statusCode);
      }

    // GET
    // /view_messages
    # Returns all messages that these two users have sent to each other in date order.
    public function viewMessages(Request $request) {
        $messages = NULL;
        $statusCode = NULL;
        $resp = NULL;
        $sortedArr = [];

        if (!$request->has('user_id_a') || !$request->has('user_id_b') || is_null($request)) {
            # Set HTTP status code to Internal Server Error because of null pointer exception from insufficient request
            $statusCode = http_response_code(500);
            $resp = [ "error_code" => $statusCode, "error_title" => "View Messages Failure", "error_message" => "Something went wrong. Check to see if you correctly included both the sender and the recipient."];
        } else {
            $messages = DB::table('messages')->get();
            $statusCode = http_response_code(200);

            // Turn response into array
            foreach ($messages as $value) {
                if ($value->sender_user_id == $request->user_id_a && $value->receiver_user_id == $request->user_id_b) {
                    array_push($sortedArr, $value);
                }
            }
            // Compare Unix timestamps
            usort($sortedArr, function($a, $b) {
                return strtotime($a->date) > strtotime($b->date) ? 1 : -1;
            });
        }

        return response($sortedArr, $statusCode);
      }

    // POST
    // /send_message
    # Sends a message from one user to another. Returns a success code if the message was sent successfully.
      public function sendMessage(Request $request) {
        $resp = NULL;
        $statusCode = NULL;
        $message = new Message;

        if (!$request->has('sender_user_id') || !$request->has('receiver_user_id') || !$request->has('message') || is_null($request)) {
            # Set HTTP status code to Internal Server Error because of null pointer exception from insufficient request
            $statusCode = http_response_code(500);
            $resp = [ "error_code" => $statusCode, "error_title" => "Send Message Failure", "error_message" => "Something went wrong. Check to see if you correctly sent the message to the recepient."];
        } else {
            $message->sender_user_id = $request->sender_user_id;
            $message->receiver_user_id = $request->receiver_user_id;
            $message->message = $request->message;
            $message->date = date('Y-m-d H:i:s');
            $message->save();

            # Set HTTP status code to Success for valid request body
            $statusCode = http_response_code(200);
            $resp = [ "success_code" => $statusCode, "success_title" => "Message Sent", "success_message" => "Message was sent successfully"];
        }

        return response()->json($resp, $statusCode);
      }

    // GET
    // /list_all_users
    # Display all of the users that have registered to use the app excluding the requester
    public function listAllUsers(Request $request) {
        $users = NULL;

        if (!$request->has('requester_user_id')) {
            $users = DB::table('users')->get()->toJson(JSON_PRETTY_PRINT);
        } else {
            $users = DB::table('users')->where('user_id', '!=', $request->requester_user_id)->get()->toJson(JSON_PRETTY_PRINT);
        }

        return response($users, 200);
      }
}