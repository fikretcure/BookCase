<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

/**
 *
 */
trait Responsed
{

    /**
     * @var
     */
    private $data;
    /**
     * @var
     */
    private $message;


    /**
     * @var int
     */
    private int $status;

    /**
     * @param $data
     * @return $this
     */
    public function success($data = null): static
    {
        $this->data = $data;
        $this->status = 200;

        return $this;
    }


    /**
     * @param $data
     * @return $this
     */
    public function fail($data = null): static
    {
        $this->data = $data;
        $this->status = 404;

        return $this;
    }


    /**
     * @param $message
     * @return $this
     */
    public function mes($message = null): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function failMes($message = null): static
    {
        $this->message = $message;
        $this->status = 404;

        return $this;
    }

    /**
     * @param int|null $status
     * @return JsonResponse
     */
    public function send(int $status = null): JsonResponse
    {
        $this->status = $status ? $status : $this->status;

        return response()->json([
            "message" => $this->message,
            "data" => $this->data,
        ], $this->status);

    }
}
