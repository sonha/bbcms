$(document).ready(function(){
    $("#searchNews").bind("click", function(){ ajaxSearchNews(); })
    $("#checkAll").bind("click", function() {
        $('#postList input[type="checkbox"]').each(function(){
            // toggle checkbox
            $(this).prop('checked',!$(this).prop('checked'));
            // toggle class
            $(this).parents('label').toggleClass('active');
        });
        $(this).prop('checked',!$(this).prop('checked'));
    })
});

function setNewsCover(pid, mid) {
  	$.ajax({
        type: 'POST',
        url: "/admin/news/setcover",
        data: {post_id: pid, media_id: mid},
        dataType: 'json',
        ifModify: false,
        success: function(data){
			$("#media-cover-id", window.parent.document).val(data.id);
			$("#cover-image", window.parent.document).html('<img src="/' + data.mpath + '/180x100_crop/' + data.mname + '" width="175" /><a class="label label-default" href="javascript:void(0)" onclick="removeNewsCover()" >Bỏ ảnh</a>');
        }
    });
}

function removeNewsCover() {
	$("#media-cover-id").val("");
	$("#cover-image").html("Chọn ảnh đại diện trong thư viện.");
}

function setPrimaryCat(pid, cid) {
    $.ajax({
        type: 'POST',
        url: "/admin/news/setcategory",
        data: {post_id: pid, category_id: cid},
        dataType: 'json',
        ifModify: false,
        success: function(data){
            $("#category-id-" + cid).css("font-weight", "bold");
        }
    });
}

function confirmDelete(e) {
    if(confirm("bạn có chắc muốn thực hiện thao tác này?")) {
        window.location.href = $(e).attr("href");
    }
}

function ajaxSearchNews() {
    var catId = $("#categoryId").val();
    var keyword = $("#keyword").val();
    var tagId = $("#tagId").val();
    $.ajax({
        type: 'GET',
        url: "/admin/news/postlist",
        data: {keyword: keyword, category_id: catId, tag_id: tagId},
        ifModify: false,
        success: function(data){
            $("#modal_addposts").html(data);
        }
    });
}