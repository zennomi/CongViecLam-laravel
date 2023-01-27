<?php

/**
 * Response success data collection
 *
 * @param object $data
 * @param string $responseName
 * @return \Illuminate\Http\Response
 */
function responseData(?object $data, string $responseName = 'data')
{
    return response()->json([
        'success' => true,
        $responseName => $data,
    ], 200);
}

/**
 * Response success data collection
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function responseSuccess(string $msg = "Success")
{
    return response()->json([
        'success' => true,
        'message' => $msg,
    ], 200);
}

/**
 * Response error data collection
 *
 * @param string $msg
 * @param int $code
 * @return \Illuminate\Http\Response
 */
function responseError(string $msg = 'Something went wrong, please try again', int $code = 404)
{
    return response()->json([
        'success' => false,
        'message' => $msg,
    ], $code);
}

/**
 * Response success flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashSuccess(string $msg)
{
    session()->flash('success', $msg);
}

/**
 * Response error flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashError(string $message)
{
    if (env('APP_DEBUG')) {
        return session()->flash('error', $message);
    } else {
        return session()->flash('error', 'Something went wrong, please try again');
    }
}
