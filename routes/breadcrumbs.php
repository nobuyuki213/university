<?php

//Top
Breadcrumbs::register('top', function ($breadcrumbs) {
	$breadcrumbs->push('TOP', route('top'), []);
});
//Top > schools
Breadcrumbs::register('schools', function ($breadcrumbs) {
	$breadcrumbs->parent('top');
	$breadcrumbs->push('大学の選択', route('schools'), []);
});
//Top > schools // 下記パンくずコードの大学を選択済み時に表示名を変更するため用
Breadcrumbs::register('schools_s', function ($breadcrumbs) {
	$breadcrumbs->parent('top');
	$breadcrumbs->push('選択した大学', route('schools'), []);
});
//Top > schools > [university.show]
Breadcrumbs::register('university.show', function ($breadcrumbs, $university, $course_ids = null, $school_years = null, $tag_ids = null) {
	$breadcrumbs->parent('schools_s');
	// 授業の条件検索実行の分岐による表示名の変更
	if ($course_ids || $school_years || $tag_ids) {
		$breadcrumbs->push($university->name . 'の授業検索結果', route('university.show', $university->id), []);
	} else {
		$breadcrumbs->push($university->name, route('university.show', $university->id), []);
	}
});
//Top > schools > [university.show] > [lesson.show]
Breadcrumbs::register('lesson.show', function ($breadcrumbs, $lesson) {
	$breadcrumbs->parent('university.show', $lesson->university);
	$breadcrumbs->push($lesson->name, route('lesson.show', $lesson->id), []);
});

Breadcrumbs::after(function ($breadcrumbs) {
    $page = (int) request('page', 1);
    if ($page > 1) {
        $breadcrumbs->push("Page $page");
    }
});

// Error 404
Breadcrumbs::register('errors.404', function ($breadcrumbs) {
    $breadcrumbs->parent('top');
    $breadcrumbs->push('Page Not Found');
});