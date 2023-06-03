let suggestion_index = -1 ;
let suggestion = [];
$('.search_line').hide();
function show_suggestion(suggestion){
    if(suggestion.length == 0)
        return ;
    let sug = '<ul>' , mx = 5 , end_show = Math.max(suggestion_index , Math.min(mx , suggestion.length - 1)), 
    start_show = Math.max(0 , end_show - mx);
    for(let i = start_show ; i <= end_show ; i++ ){
        if(i == suggestion_index){  
            sug += '<li class = "background_grey" >' + suggestion[i] + '</li>' 
        }
        else
            sug += '<li>' + suggestion[i] + '</li>' ;
    }
    sug += '</ul>' ;
    
    $('.search_line').show();
    $('#list').show();
    $('#list').html(sug) ;
}
$('#search').keyup(function(event){
    let tex = $('#search').val() ;
    console.log(event.key.length) ;
    if(event.key == 'ArrowUp'){
        event.preventDefault();
        if(suggestion_index > 0){
            suggestion_index-- ;
            $('#search').val(suggestion[suggestion_index]) ;
        }
    }
    else if(event.key == 'ArrowDown'){
        event.preventDefault();
        if(suggestion_index < suggestion.length - 1){
            suggestion_index++ ;
            $('#search').val(suggestion[suggestion_index]);
        }
    }
    else if(tex != ""){
        $.ajax({
            url: "script/autocomplete.php",
            method : "POST" ,
            data : {
                search : tex 
            },
            success : function(data){
                suggestion = JSON.parse(data) ;
                show_suggestion(suggestion);
            }
        }) ;
    }
    else{
        suggestion = [] ;
        $('#list').hide();
        $('.search_line').hide();
    }
    show_suggestion(suggestion);
});
$('.search_box').on('click', function(){  
    if(suggestion_length){
        $('#list').show();  
        $('.search_line').show();  
    }
});
$(document).on('click', 'li', function(){  
    $('#search').val($(this).text());  
    $('#list').hide();  
    $('.search_line').hide();  
});
$(document).on('click', function(){   
    $('#list').hide();  
    $('.search_line').hide();  
});