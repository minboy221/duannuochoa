<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $order = $this->route('order');
        $currentStatus = $order->status;

        $allowedTransitions = [
            'Chờ thanh toán' => ['Chờ thanh toán', 'Đã hủy', 'Chờ xác nhận'],
            'Chờ xác nhận' => ['Chờ xác nhận', 'Đã xác nhận', 'Đã hủy'],
            'Đã xác nhận' => ['Đã xác nhận', 'Đang chuẩn bị hàng', 'Đã hủy'],
            'Đang chuẩn bị hàng' => ['Đang chuẩn bị hàng', 'Đang giao', 'Đã hủy'],
            'Đang giao' => ['Đang giao', 'Đã giao hàng'],
            'Đã giao hàng' => ['Đã giao hàng', 'Đã hoàn thành', 'Trả hàng/Hoàn tiền'],
            'Đã hoàn thành' => ['Đã hoàn thành'],
            'Đã hủy' => ['Đã hủy'],
            'Trả hàng/Hoàn tiền' => ['Trả hàng/Hoàn tiền'],
        ];

        $validStatuses = $allowedTransitions[$currentStatus] ?? [$currentStatus];
        $validStatusesStr = implode(',', $validStatuses);

        return [
            'status' => "required|string|in:$validStatusesStr",
            'cancel_reason' => 'required_if:status,Đã hủy|nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Vui lòng chọn trạng thái đơn hàng.',
            'status.in' => 'Trạng thái chuyển đổi không hợp lệ hoặc không theo đúng quy trình.',
            'cancel_reason.required_if' => 'Vui lòng nhập lý do hủy đơn hàng.',
        ];
    }
}
