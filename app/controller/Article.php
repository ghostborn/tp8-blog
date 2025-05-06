<?php

namespace app\controller;

use think\facade\View;
use think\facade\Session;
use think\facade\Request;
use app\model\Article as ArticleModel;

class Article
{
    public function index()
    {
        $articles = ArticleModel::with('user')->order('created_at', 'desc')->select();
        return View::fetch('article/index', [
            'articles' => $articles,
            'success' => Session::get('success'),
            'error' => Session::get('error'),
            'username' => Session::get('username')
        ]);
    }

    public function create()
    {
        return View::fetch('article/create');
    }

    public function save()
    {
        $data = Request::only(['title', 'content']);
        if (empty($data['title'])) {
            return redirect('/article/create')->with('error', '标题不能为空');
        }
        ArticleModel::create([
            'user_id' => Session::get('user_id'),
            'title' => $data['title'],
            'content' => $data['content'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('/article')->with('success', '文章创建成功');
    }

    // 文章详情
    public function show($id)
    {
        $article = ArticleModel::with('user')->find($id);
        if (!$article) {
            return redirect('/article')->with('error', '文章不存在');
        }
        return View::fetch('article/show', [
            'article' => $article
        ]);
    }

    public function edit($id)
    {
        $article = ArticleModel::find($id);
        if (!$article || $article->user_id != Session::get('user_id')) {
            return redirect('/article')->with('error', '无权编辑此文章');
        }
        return View::fetch('article/edit', [
            'article' => $article
        ]);
    }

    public function update($id)
    {
        $article = ArticleModel::find($id);
        if (!$article || $article->user_id != Session::get('user_id')) {
            return redirect('/article')->with('error', '无权更新此文章');
        }
        $data = Request::only(['title', 'content']);
        if (empty($data['title'])) {
            return redirect('/article/edit' . $id)->with('error', '标题不能为空');
        }
        $article->save($data);
        return redirect('/article/' . $id)->with('success', '文章更新成功');
    }

    public function delete($id)
    {
        $article = ArticleModel::find($id);
        if (!$article || $article->user_id != Session::get('user_id')) {
            return redirect('/article')->with('error', '无权删除此文章');
        }
        $article->delete();
        return redirect('/article')->with('success', '文章删除成功');
    }


}