<?php

namespace App\Controllers;

use App\Models\{ RatingViewModel, CategoryModel };

class Home extends BaseController
{
    public function index()
    {
        $ratingViewModel = new RatingViewModel();
        $categoryModel = new CategoryModel();
        
        $data['categories'] = $categoryModel
            ->select('category.*, COUNT(thread.id) as thread_count')
            ->join('thread', 'thread.category_id = category.id', 'left')
            ->groupBy('category.id')
            ->findAll();

        $data['topThread'] = $ratingViewModel
            ->select('thread.title, rating_view.thread_id, rating_view.star_sum, rating_view.rating')
            ->join('thread', 'thread.id=rating_view.thread_id', 'left')
            ->orderBy('rating_view.rating', 'DESC')
            ->orderBy('rating_view.star_sum', 'DESC')
            ->get(5, 0);

        $data['title'] = 'Home';
        return view('home', $data);
    }
}
