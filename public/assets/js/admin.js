$(document).ready(function(){
    $("#searchNews").bind("click", function(){ ajaxSearchNews(); })
    $("#searchTags").bind("click", function(){ ajaxSearchTags(); })

    $('#tagName').keypress(function(event) {
        if (event.keyCode == 13) {
            addTagtoPost('tag', '', '');
            return false;
        }
    });

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

function ajaxSearchTags() {
    var order = $("#orderByDate").val();
    var keyword = $("#keyword").val();
    $.ajax({
        type: 'GET',
        url: "/admin/tags/listpopup",
        data: {keyword: keyword, order: order},
        ifModify: false,
        success: function(data){
            $("#modal_taglist").html(data);
        }
    });
}

function addTagtoPost(type, tid, name) {
    if(type=="tag") {
        var tagName = $("#tagName").val();
        if(tagName!="" && tagName.length >2) {
            console.log(tagName);
            $.ajax({
                type: 'POST',
                url: "/admin/tags/ajaxcreate",
                data: {name: tagName},
                dataType: 'json',
                ifModify: false,
                success: function(data){
                    tagAppend(type, data.id, data.name);
                }
            });
        }
    } else {
        tagAppend(type, tid, name);
    }    
}

function tagAppend(type, tid, name) {
    var ids = $("#"+ type +"Ids").val();
    var idArr = ids!="" ? ids.split(',') : [];
    // push id to array
    idArr.push(tid);
    $("#"+ type +"Ids").val(idArr.join(','));
    $("#"+ type +"List").append('<p><a href="javascript:void(0)" onclick="removeTaginPost(\'topic\', '+ tid +', this)" class="btn btn-default btn-xs">X</a> '+ name +'</p>');
}

function removeTaginPost(type, tid, e) {
    var ids = $("#"+ type +"Ids").val();
    var idArr = ids.split(',');
    idArr.splice( $.inArray(tid, idArr), 1 );
    $("#"+ type +"Ids").val(idArr.join(','));
    $(e).parent().remove();
}