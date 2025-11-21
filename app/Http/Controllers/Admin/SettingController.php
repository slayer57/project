<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.setting.edit', compact('settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $siteSettings = Setting::pluck('value', 'key');

        //global 
        $old_main_logo = $siteSettings['site_main_logo'];
        $old_footer_logo = $siteSettings['site_footer_logo'];
        $old_fav_icon = $siteSettings['fav_icon'];

        //home
        $old_top_notification_banner = $siteSettings['top_notification_banner'];

        //banner
        $old_about_page_banner = $siteSettings['about_page_banner'];
        $old_team_page_banner = $siteSettings['team_page_banner'];
        $old_blog_page_banner = $siteSettings['blog_page_banner'];
        $old_single_page_banner = $siteSettings['single_page_banner'];
        $old_package_page_banner = $siteSettings['package_page_banner'];
        $old_feature_banner = $siteSettings['feature_banner'];

        $input = $request->all();
        $site_main_logo = $this->fileUpload($request, 'site_main_logo');
        $site_footer_logo = $this->fileUpload($request, 'site_footer_logo');
        $fav_icon = $this->fileUpload($request, 'fav_icon');
        $top_notification_banner = $this->fileUpload($request, 'top_notification_banner');

        //banner
        $about_page_banner = $this->fileUpload($request, 'about_page_banner');
        $team_page_banner = $this->fileUpload($request, 'team_page_banner');
        $blog_page_banner = $this->fileUpload($request, 'blog_page_banner');
        $single_page_banner = $this->fileUpload($request, 'single_page_banner');
        $package_page_banner = $this->fileUpload($request, 'package_page_banner');
        $feature_banner = $this->fileUpload($request, 'feature_banner');


        //delete old file
        if ($site_main_logo) {
            $this->removeFile($old_main_logo);
            $input['site_main_logo'] = $site_main_logo;
        } else {
            unset($input['site_main_logo']);
        }

        if ($site_footer_logo) {
            $this->removeFile($old_footer_logo);
            $input['site_footer_logo'] = $site_footer_logo;
        } else {
            unset($input['site_footer_logo']);
        }

        if ($fav_icon) {
            $this->removeFile($old_fav_icon);
            $input['fav_icon'] = $fav_icon;
        } else {
            unset($input['fav_icon']);
        }

        if ($top_notification_banner) {
            $this->removeFile($old_top_notification_banner);
            $input['top_notification_banner'] = $top_notification_banner;
        } else {
            unset($input['top_notification_banner']);
        }

        if ($about_page_banner) {
            $this->removeFile($old_about_page_banner);
            $input['about_page_banner'] = $about_page_banner;
        } else {
            unset($input['about_page_banner']);
        }

        if ($team_page_banner) {
            $this->removeFile($old_team_page_banner);
            $input['team_page_banner'] = $team_page_banner;
        } else {
            unset($input['team_page_banner']);
        }

        if ($blog_page_banner) {
            $this->removeFile($old_blog_page_banner);
            $input['blog_page_banner'] = $blog_page_banner;
        } else {
            unset($input['blog_page_banner']);
        }

        if ($single_page_banner) {
            $this->removeFile($old_single_page_banner);
            $input['single_page_banner'] = $single_page_banner;
        } else {
            unset($input['single_page_banner']);
        }

        if ($package_page_banner) {
            $this->removeFile($old_package_page_banner);
            $input['package_page_banner'] = $package_page_banner;
        } else {
            unset($input['package_page_banner']);
        }

        if ($feature_banner) {
            $this->removeFile($old_feature_banner);
            $input['feature_banner'] = $feature_banner;
        } else {
            unset($input['feature_banner']);
        }

        //end

        foreach ($input as $key => $value) {
            $setting->updateOrCreate(['key' => $key,], [
                'key' => $key,
                'value' => $value,
            ]);
        }
        return redirect()->back()->with('message', 'Setting Updated Successfully');
    }


    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/setting';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
            return $imageName;
        } else {
            return null;
        }
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/setting/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
