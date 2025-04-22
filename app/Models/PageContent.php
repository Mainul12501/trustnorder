<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page_type',
        'content',
        'description',
        'status',
    ];

    public static function createOrUpdatePageContent($request, $id = null)
    {
        if (isset($id))
        {
            $pageContent    = PageContent::find($id);
        }
        elseif ($request->page_type == 'policy')
        {

            $existPageContent = PageContent::where('page_type', 'policy')->first();
            if (isset($existPageContent)){
                $pageContent = $existPageContent;
            } else {
                $pageContent = new PageContent();
            }

        } elseif ($request->page_type == 'support')
        {
            $existPageContent = PageContent::where('page_type', 'support')->first();
            if (isset($existPageContent))
            {
                $pageContent = $existPageContent;
            } else {
                $pageContent = new PageContent();
            }
        } else {
            $pageContent = new PageContent();
        }
        $pageContent->page_type = $request->page_type;
        $pageContent->content = $request->content;
        $pageContent->status = $request->status == 'on' ? 1 : 0;
        $pageContent->save();
    }

}
