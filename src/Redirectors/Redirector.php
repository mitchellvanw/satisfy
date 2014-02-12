<?php namespace Mitch\Satisfy\Redirectors;

interface Redirector
{
    public function to($path, $status = 302);
}