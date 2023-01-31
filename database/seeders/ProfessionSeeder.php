<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
            'Vật lý học', 'Kĩ sư', 'Đầu bếp', 'Luật sư', 'Thiết kế', 'Công nhân', 'Bác sĩ', 'Kế toán', 'Vệ sinh răng miệng', 'Diễn viên', 'Thợ điện', 'Kĩ sư phần mềm', 'Dược sĩ', 'Kỹ thuật viên', 'Nghệ sĩ', 'Giáo viên', 'Nhà báo', 'Thu ngân', 'Thư ký', 'Nhà khoa học', 'Binh sĩ', 'Người làm vườn', 'Nông dân', 'Thủ thư', 'Tài xế', 'ngư dân', 'Cảnh sát ', 'Thợ may'
        ];
        
        foreach ($professions as $profession) {
            Profession::create([
                'name' => $profession,
                'slug' => Str::slug($profession),
            ]);
        }
    }
}
