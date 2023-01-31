<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\IndustryType;
use Illuminate\Database\Seeder;

class IndustryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industry_types = [
            "Công nghiệp dựa trên nông nghiệp",
            "Kiến trúc/Xây dựng",
            "Ô tô/Máy công nghiệp",
            "Ngân hàng /Fintech",
            "Điện tử/Hàng tiêu dùng lâu bền",
            "Năng lượng/Sức mạnh/Nhiên liệu",
            "Hàng may mặc/Dệt may",
            "Tự động hoá",
            "Dược phẩm",
            "Bệnh viện/Trung tâm chẩn đoán",
            "Hàng không/Du lịch",
            "Sản xuất (Công nghiệp nhẹ)",
            "Sản xuất (Công nghiệp nặng)",
            "Khách sạn/Nhà hàng",
            "Công nghệ thông tin",
            "Hậu Cần/Vận Tải",
            "Giải trí/Giải trí",
            "Truyền thông/Quảng cáo/Sự kiện",
            "Phi tổ chức/Phát triển",
            "Bất động sản",
            "Bán buôn/Bán lẻ/Xuất nhập khẩu",
            "Viễn thông",
            "Ngành Thực phẩm & Đồ uống",
            "Dịch vụ an ninh",
            "Phòng cháy chữa cháy, An toàn & Bảo vệ"
        ];

        foreach ($industry_types as $type) {
            IndustryType::create([
                'name' => $type,
                'slug' => Str::slug($type),
            ]);
        }
    }
}
