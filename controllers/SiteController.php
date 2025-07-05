<?php

namespace app\controllers;

use shenoda\phpmvc\Application;
use shenoda\phpmvc\Controller;
use shenoda\phpmvc\Request;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $name = Application::$app->user->firstname ?? "";
        $params = [
            'name' => $name,
        ];
        return $this->render('home', $params);
    }
    public function contact(Request $request)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                Application::$app->response->redirect('/contact');
            }
        }
        return $this->render('contact', ['model' => $contact]);
    }
}