<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PagesEditController extends Controller
{
    //
    public function execute(Page $page, Request $request)
    {
        if ($request->isMethod('delete')) {
            if ($page->delete()) {
                return redirect('admin')->with('status', 'Страница удалена');
            }
        }

        if ($request->isMethod('post')) {

            $input = $request->except('_token');

            $request->validate([
                'name' => 'required|max:100',
                'alias' => 'required|max:100|unique:pages,alias,' . $input['id'],
                'text' => 'required'
            ], [
                'name.required' => 'Поле "Название" обязательно для заполнения.',
                'name.max' => 'Количество символов в поле "Название" не может превышать 100.',
            ]);

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path('assets/img'), $input['images']);
            } else {
                $input['images'] = $input['old_images'];
            }
            unset($input['old_images']);

            $page->fill($input);
            if ($page->update()) {
                return redirect('admin')->with('status', 'Страница обновлена');
            }
        }

//        $old = $page->toArray();
        if (view()->exists('admin.pages_edit')) {
            return view('admin.pages_edit', [
                'title' => 'Редактирование страницы – ' . $page->name,
                'page' => $page
            ]);
        }
    }
}
