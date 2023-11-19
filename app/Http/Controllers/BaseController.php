<?php
namespace App\Http\Controllers;

interface BaseController {
    public function index();
    public function create();
    public function store();
    public function edit($id);
    public function update($id);
    public function show($id);
    public function destroy($id);
    public function trash($id);
    public function restore($id);
}
