<?php namespace Mitch\Satisfy\Redirectors;

class NativeRedirector implements Redirector
{
    public function to($path, $status = 302)
    {
        header("Location: $path", true, $status);
        die;
    }
}