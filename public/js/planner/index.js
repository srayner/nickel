$(document).ready(function(){
    $('.planner').civresource({
        fetchUrl: '/job/json',
        updateUrl: '/job/update'
    }); 
});