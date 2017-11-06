<?php

namespace App\Controllers;

use App\View;

class PagesController extends Controller
{
    /**
     * Load welcome page
     */
    public function welcome()
    {
        $_SESSION['status'] = 'Welcome ...';

        view('welcome.php');
    }

    /**
     * Clear all session data
     */
    public function clear()
    {
        session_unset();

        $_SESSION['status'] = 'Session data cleared.';

        view('welcome.php');
    }
}
