var jobData;
var periodStart;
    
(function($) {
        
    $.fn.civresource = function(options) {
    
        // ----------Private variables -----------------------------------------
        var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        var months = ['January', 'February', 'March', 'April', 'May', 'June',
                      'July', 'August', 'September', 'October', 'November', 'December'];
        
        // ----------Helper functions ------------------------------------------
        function zeroPad(number){
            if (number < 10) {
                return '0' + number.toString();
            } else {
                return number.toString();
            }
        }

        function formatDate(date) {
            var day = zeroPad(date.getDate());
            var month = zeroPad(date.getMonth() + 1);
            var year = date.getFullYear();
            return (day + '/' + month + '/' + year);
        }
        //----------------------------------------------------------------------
        
        //------------Event handlers -------------------------------------------
        var myAllowDropFunction = function(ev) {
            ev.preventDefault();
        };

        var myDragFunction = function(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        };

        var myDropFunction = function(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");

            // Update the DOM
            var target = ev.target;
            var tagname = target.tagName.toLowerCase();
            if (tagname !== 'td') {
                target = target.parentElement;
            }
            target.appendChild(document.getElementById(data));

            // Update the local data
            var job = jobData[data.substring(1)];
            var newDate = new Date(periodStart);
            newDate.setDate(newDate.getDate() + (target.cellIndex - 1));
            job.staff_id = target.parentNode.id.substring(1);
            job.job_date = formatDate(newDate);
            
            // Pass the updated data to the server
            $.ajax(settings.updateUrl, {data: job, method: 'POST'})
            .fail(function() {
                alert( "Error updating server." );
            });

        };
        //----------------------------------------------------------------------
        
        // ----------Private methods -------------------------------------------
        var updatePeriod = function(){
            $('#planner-period').html(periodStart.getDate() + ' ' + months[periodStart.getMonth()] + ' ' + periodStart.getFullYear());    
        };
    
        var getMonday = function(d) {
            d = new Date(d);
            var day = d.getDay(),
            diff = d.getDate() - day + (day === 0 ? -6:1); // adjust when day is sunday
            return new Date(d.setDate(diff));
        };
        
        var getWeekText = function(d) {
            var myDate = new Date(d);
            var text = myDate.getDate() + ' ' + months[myDate.getMonth()] + ' - ';
            myDate.setDate(myDate.getDate() + 6);
            text += myDate.getDate() + ' ' + months[myDate.getMonth()] + ' ' + myDate.getFullYear();
            return text;
        };

        var addCell = function(row, tag, classname, text) {
            var cell = document.createElement(tag);
            cell.innerHTML = text;
            cell.className=classname;
            row.appendChild(cell);
            return cell;
        };

        var addWeek = function(d) {
            $(".planner tr").each(function(index){
                if (index === 0) {
                    var text = getWeekText(d);    
                    var cell = addCell(this, 'th', 'planner-week', text);
                    $(cell).attr('colspan', '7');
                } else if (index === 1) {
                    for(var i=0; i<7; i++) {
                        var text = days[d.getDay()] + '<br><span class="date">' + d.getDate() + '</span>';
                        addCell(this, "th", "day", text);
                        d.setDate(d.getDate() + 1);
                    }
                } else {
                    for(var i=0; i<7; i++) {
                        var className = "job-target";
                        if (i >= 5) {
                            className += " weekend";
                        }
                        addCell(this, "td", className, "");
                    }
                }
                $('.job-target').each(function(index, element){
                    element.addEventListener('dragover', myAllowDropFunction, false);
                    element.addEventListener('drop', myDropFunction, false);
                });
            });
        };
        
        var updateWeeks = function(){
    
            // Week headers
            d = new Date(periodStart);
            $('.planner thead tr:nth-child(1) th:nth-child(2)').html(getWeekText(d));
            d.setDate(d.getDate() + 7);
            $('.planner thead tr:nth-child(1) th:nth-child(3)').html(getWeekText(d));
            d.setDate(d.getDate() + 7);
            $('.planner thead tr:nth-child(1) th:nth-child(4)').html(getWeekText(d));
            d.setDate(d.getDate() + 7);
            $('.planner thead tr:nth-child(1) th:nth-child(5)').html(getWeekText(d));

            // Day headers
            d = new Date(periodStart);
            $('.planner-title th').each(function(index){
                var text = days[d.getDay()] + '<br><span class="date">' + d.getDate() + '</span>';
                $(this).html(text);
                d.setDate(d.getDate() + 1);
            });

        };
        
        var addJob = function(col, job){
            element = document.createElement('div');
            element.innerHTML = job.job_id;
            element.id = 'j'+ job.job_id;
            element.className = "job";
            if (job.job_type === "fixed") {
                element.className = "job fixed-job";
            } else {
                element.addEventListener('dragstart', myDragFunction, false);
                $(element).attr('draggable', 'true');
             //             .attr('ondragstart', 'drag(event)');
            }
            var selector = '#s' + job.staff_id + ' td:nth-child(' + col +')';
            td = $(selector)[0];
            td.appendChild(element);
        };
        
        fetchData = function(){
            
            // Clear existing jobs.
            $('.planner tbody td').html('');
            jobData = {};
            
            // Make ajax request to fetch data from server.
            $.ajax(settings.fetchUrl, {dataType: "json"})
            
            .done(function(obj) {
                $.each(obj.jobs, function(i, job) {
                    var jobDate = new Date(job.job_date);
                    jobDate.setHours(0,0,0,0);
                    var col = diffDays(periodStart, jobDate);
                    if ((col >= 0) && (col <= 27)) {
                        jobData[job.job_id] = job;
                        addJob(col + 2, job);
                        }
                    });
            })
            
            .fail(function() {
                alert( "error" );
            });
        };
        
        var diffDays = function(date1, date2){
            var timeDiff = date2.getTime() - date1.getTime();
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
            return diffDays;    
        };

        var settings = $.extend({
            noOfWeeks: 4,
            fetchUrl: 'data/sample.json',
            updateUrl: 'data/update.php'
        }, options);
        
        periodStart = getMonday(new Date());
        periodStart.setHours(0,0,0,0);
        updatePeriod();
    
        /* Add event handlers */
        $('#planner-next').click(function() {
            periodStart.setDate(periodStart.getDate() + 7);
            updatePeriod();
            updateWeeks();
            fetchData();
        });

        $('#planner-prev').click(function() {
            periodStart.setDate(periodStart.getDate() - 7);
            updatePeriod();
            updateWeeks();
            fetchData();
        });
    
        /* Add four weeks of space */
        d = new Date(periodStart);
        $('#add-week').click(addWeek(d));
        $('#add-week').click(addWeek(d));
        $('#add-week').click(addWeek(d));
        $('#add-week').click(addWeek(d));

        // Add data
        fetchData();
        
        return this;    
    };
    
}(jQuery));