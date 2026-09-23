<?php

if (! function_exists('AddData')) {
    function AddData($model, $data)
    {
        return $model::create($data);
    }

}

if (! function_exists('GetSingleData')) {

    function GetSingleData($model, $condition = [])
    {
        return $model::where($condition)->first();
    }
}
if (! function_exists('getAll')) {
    function getAll($model)
    {
        return $model::paginate(10);
    }
}

if (! function_exists('UpdateData')) {

    function UpdateData($model, $data, $condition = [])
    {
        return $model::where($condition)->update($data);
    }
}

if (! function_exists('DeleteData')) {
    function DeleteData($model, $condition = [])
    {
        return $model::where($condition)->delete();
    }
}

if (! function_exists('LazyLoadData')) {

    function LazyLoadData($model, $relationdata = [], $condition = [])
    {
        return $model::with($relationdata)
            ->where($condition)
            ->get();
    }
}

if (! function_exists('CountData')) {
    function CountData($model)
    {
        return $model::count();
    }
}
