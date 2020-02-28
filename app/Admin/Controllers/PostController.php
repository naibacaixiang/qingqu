<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Post';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('content', __('Content'));
        $grid->column('user_id', __('User id'));
        $grid->column('category_id', __('Category id'));
        $grid->column('tags', __('Tags'));
        $grid->column('reply_count', __('Reply count'));
        $grid->column('view_count', __('View count'));
        $grid->column('gift_count', __('Gift count'));
        $grid->column('status', __('Status'));
        $grid->column('download_link', __('Download link'));
        $grid->column('excerpt', __('Excerpt'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('user_id', __('User id'));
        $show->field('category_id', __('Category id'));
        $show->field('tags', __('Tags'));
        $show->field('reply_count', __('Reply count'));
        $show->field('view_count', __('View count'));
        $show->field('gift_count', __('Gift count'));
        $show->field('status', __('Status'));
        $show->field('download_link', __('Download link'));
        $show->field('excerpt', __('Excerpt'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->text('title', __('Title'));
        $form->editor('content');
//        $form->textarea('content', __('Content'));
        $form->number('user_id', __('User id'));
        $form->number('category_id', __('Category id'));
        $form->text('tags', __('Tags'));
        $form->number('reply_count', __('Reply count'));
        $form->number('view_count', __('View count'));
        $form->number('gift_count', __('Gift count'));
        $form->text('status', __('Status'))->default('public');
        $form->text('download_link', __('Download link'));
//        $form->textarea('excerpt', __('Excerpt'));

        return $form;
    }
}
