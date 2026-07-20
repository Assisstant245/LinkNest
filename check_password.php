<?php

$row = DB::table('users')->where('id', 4)->first();

dd($row);