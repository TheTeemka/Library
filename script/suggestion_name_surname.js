let suggestion_index = -1 ;
let suggestion = [];
let search = '#search' , 
list = '#list'  , 
search_line = '.search_line' ,
database = `student` ,
type = `name_surname` , 
num = 10 ;
function show_suggestion(){
    if(suggestion.length == 0){
        $(search_line).hide();
        $(list).hide();
        return ;
    }
    let sug = '<ul>' , mx = num, end_show = Math.max(suggestion_index , Math.min(mx , suggestion.length - 1)), 
    start_show = Math.max(0 , end_show - mx);
    for(let i = start_show ; i <= end_show ; i++ ){
        if(i == suggestion_index){  
            sug += '<li class = "background_grey" >' + suggestion[i] + '</li>' 
        }
        else
            sug += '<li>' + suggestion[i] + '</li>' ;
    }
    sug += '</ul>' ;
    console.log(sug) ;
    $(search_line).show();
    $(list).show();
    $(list).html(sug) ;
}

$(search).keyup(function(event){
    let tex = $(search).val() ;
    if(event.key == 'ArrowRight' || event.key == 'ArrowLeft')
        return ;
    if(event.key == 'ArrowUp'){
        event.preventDefault();
        if(suggestion_index > 0){
            suggestion_index-- ;
            $(search).val(suggestion[suggestion_index]) ;
        }
    }
    else if(event.key == 'ArrowDown'){
        event.preventDefault();
        if(suggestion_index < suggestion.length - 1){
            suggestion_index++ ;
            $(search).val(suggestion[suggestion_index]);
        }
    }
    else if(tex != ""){
        suggestion_index = -1;
        $.ajax({
            url: "script/autocomplete_search.php",
            method : "POST" ,
            data : {
                search : tex ,
                type : type ,
                database : database 
            },
            success : function(data){
                suggestion = JSON.parse(data) ;
                show_suggestion();
            }
        }) ;
    }
    else{
        suggestion = [] ;
    }
    show_suggestion();
});
$(search).on('click' , function(event){
    console.log("lenght " + suggestion.length) ; 
    show_suggestion() ;
    event.stopPropagation();  
});
$(document).on('click', 'li', function(){  
    $(search).val($(this).text());  
    $(list).hide();  
    $(search_line).hide();  
});
$(document).on('click', function(){ 
    console.log('huina');  
    $(list).hide();  
    $(search_line).hide();  
});
