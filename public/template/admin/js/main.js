$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if(confirm("Xóa mà không thể khôi phục. Bạn có chắc không ?")){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function(result) {
                if(!result.error) {
                    alert(result.message);
                    location.reload();
                }else{
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}