<?php

namespace Modules\Faq\Actions;

use Modules\Faq\Entities\FaqCategory;

class SortingFaqCategory
{
    public static function sort($request)
    {
        $tasks = FaqCategory::all();
        foreach ($tasks as $task) {
            $task->timestamps = false; // To disable update_at field updation
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order' => $order['position']]);
                }
            }
        }

        return true;
    }
}
