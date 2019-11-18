<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Company;
use App\Employee;
use App\Tag;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\View;

class TagController extends Controller
{
    public function tagIndex($tag_name)
    {
        //
        $Tag = Tag::where("tag_name", '=', $tag_name)->firstOrFail();
        return view("tags")->with('tag', $Tag);
    }
    public function getEmployeeTags($employee_id) //*done
    {

        $employee = Employee::findOrFail($employee_id);
        $tags_names = array();
        foreach ($employee->tags as $tag) {
            $tags_names[] = $tag->tag_name;
        }

        return view("tags_list")->with("tags", $tags_names);
    }
    public function getCompanyTags($company_id) //*done
    {

        $company = Company::findOrFail($company_id);
        $tags_names = array();
        foreach ($company->tags as $tag) {
            $tags_names[] = $tag->tag_name;
        }
        return view("tags_list")->with("tags", $tags_names);
    }


    public function setEmployeeTags($tag_name, $employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        //check if the tag is alrady linked
        foreach ($employee->tags as $tag) {
            if ($tag->tag_name == $tag_name) {
                return "tag is linked";
            }
        }

        //check if tag is created before but not linked
        try {
            $Tag = Tag::where("tag_name", '=', $tag_name)->firstOrFail();
            $Tag->save();
        } catch (ModelNotFoundException $exception) {
            //tag not found, creating one
            $Tag = new Tag;
            $Tag->tag_name = $tag_name;
            $Tag->save();
        }
        \DB::table('taggables')->insert([
            'tag_id' => $Tag->id,
            'taggable_id' => $employee->id,
            'taggable_type' => 'App\Employee'
        ]);
        return "done";
    }
    public function setCompanyTags($tag_name, $company_id)
    {
        $company = Company::findOrFail($company_id);

        //check if the tag is alrady linked
        foreach ($company->tags as $tag) {
            if ($tag->tag_name == $tag_name) {
                return "tag is linked";
            }
        }

        //check if tag is created before but not linked
        try {
            $Tag = Tag::where("tag_name", '=', $tag_name)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            //tag not found, creating one
            $Tag = new Tag;
            $Tag->tag_name = $tag_name;
            $Tag->save();
        }
        \DB::table('taggables')->insert([
            'tag_id' => $Tag->id,
            'taggable_id' => $company->id,
            'taggable_type' => 'App\Company'
        ]);
        return "done";
    }

    public function unlinkEmployeeTag($tag_name, $employee_id)
    {
        $tag = Tag::where("tag_name", '=', $tag_name)->firstOrFail();
        \DB::table('taggables')->where('taggable_id', '=', $employee_id)->where('taggable_type', '=', 'App\employee')->where('tag_id', '=', $tag->id)->delete();
        if (($tag->employees->count() + $tag->companies->count()) == 0) {
            Tag::destroy($tag->id);
        }

        return "done";
    }
    public function unlinkCompanyTag($tag_name, $company_id)
    {
        $tag = Tag::where("tag_name", '=', $tag_name)->firstOrFail();
        \DB::table('taggables')->where('taggable_id', '=', $company_id)->where('taggable_type', '=', 'App\Company')->where('tag_id', '=', $tag->id)->delete();
        if (($tag->employees->count() + $tag->companies->count()) == 0) {
            Tag::destroy($tag->id);
        }

        return "done";
    }

    public function deleteTag($tag_id)
    {
        $tag = Tag::findOrFail($tag_id);
        \DB::table('taggables')->where('tag_id', '=', $tag->id)->delete();
        Tag::destroy($tag->id);


        return \Redirect::back();
    }
}
