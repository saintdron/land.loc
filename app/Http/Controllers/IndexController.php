<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Page;
use App\Service;
use App\Portfolio;
use App\People;

class IndexController extends Controller
{
    //
	public function execute(Request $request) {

		$pages = Page::all();
		$services = Service::where('id', '<', 20)->get();
		$portfolios = Portfolio::get(['name', 'filter', 'images']);
		$peoples = People::take(3)->get();
		$tags = DB::table('portfolios')->distinct()->pluck('filter');

		$menu = [];
		foreach ($pages as $page)
			array_push($menu, ['title' => $page->name, 'alias' => $page->alias]);
		$items = [
					['title' => 'services', 'alias' => 'service'],
					['title' => 'portfolio', 'alias' => 'portfolio'],
					['title' => 'clients', 'alias' => 'clients'],
					['title' => 'team', 'alias' => 'team'],
					['title' => 'contact us', 'alias' => 'contact']
				 ];
		$menu = array_merge($menu, $items);

		return view('index', [
								'pages' => $pages,
								'services' => $services,
								'portfolios' => $portfolios,
								'peoples' => $peoples,
								'menu' => $menu,
								'tags' => $tags,
							 ]);
	}
}
