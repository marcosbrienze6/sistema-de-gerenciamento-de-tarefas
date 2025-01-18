<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    public function sendEmail(Request $request, $type)
    {
        $user = auth('api')->user();
        $userData['user_id'] = $user->id;

         $data = [
            'recipient' => $request->input('email'), 
            'name' => $request->input('name') ?? 'Usuário',
            'body' => 'Sei la teste da silva ferreira',
            'title' => 'cacetinhodasivla',
        ];
    
        switch ($type) {
            case 'password_reset':
                $data['title'] = 'Recuperação de Senha';
                $data['body'] = 'Clique no link abaixo para redefinir sua senha:';
                $data['link'] = url('/reset-password?token=' . uniqid());
                break;

            case 'order_notification':
                $data['title'] = 'Confirmação de Pedido';
                $data['body'] = 'Seu pedido foi processado com sucesso.';
                $data['link'] = url('/meus-pedidos');
                break;

            case 'price_alert';
                $data['title'] = 'Pedido de Amizade';
                $data['body'] = 'Algum maluco quer contato';
                $data['link'] = url('/friend-request');
                break;

            default:
                return response()->json(['error' => 'Tipo de email inválido.'], 400);
        }

        Mail::send('abandonedCart', ['data' => $data], function ($message) use ($data) {
            $message->to($data['recipient'])->subject($data['title']);    
        });
    
        return response()->json(['success' => true, 'message' => 'E-mail enviado com sucesso usando template Blade!']);
    } 
}
