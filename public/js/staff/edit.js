$(document).ready(function(){
    
    // Birth date
    $('#birth-date-input').datetimepicker({
        format: 'DD/MM/YYYY',
        showClear: true
    });
    $('#birth-date-input').val('');
    
    // Hire date
    $('#hire-date-input').datetimepicker({
        format: 'DD/MM/YYYY',
        showClear: true
    });
    $('#hire-date-input').val('');
    
});