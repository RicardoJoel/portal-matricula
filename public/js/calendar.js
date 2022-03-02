$(() => {
    moment.locale('es');
    var color = '#EA5E24';
    var today = new Date();
    var tmrrw = new Date();
    tmrrw.setDate(today.getDate() + 1);
    tmrrw.setHours(0, 0, 0);
    var project = null;
    var separado = '\n---------------\n';
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        plugins: ['interaction','timeGrid','dayGrid'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        height: window.matchMedia("(max-width: 767px)").matches ? 540 : 570,
        locale: 'es',
        navLinks: true,
        editable: true,
        eventLimit: true,
        selectable: true,
        allDaySlot: false,
        buttonIcons: true,
        selectMirror: true,
        nowIndicator: true,
        eventOverlap: false,
        scrollTime: '09:00:00',
        defaultView: 'timeGridWeek',
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5],
            startTime: '09:00',
            endTime: '19:00',
        },
        select: (info) => {
            if (info.start < tmrrw && info.end < tmrrw && info.start.getMonth() == today.getMonth() &&
                (info.end.getMonth() == today.getMonth() || info.end.getMonth() == tmrrw.getMonth())) {
                $('#txt-date').text(moment(info.start).format('dddd, DD [de] MMMM'));
                $('#aux-ini').val(moment(info.start).format());
                $('#aux-fin').val(moment(info.end).format());
                $('#pkr-ini').val(moment(info.start).format('LT').padStart(5, 0));
                $('#pkr-fin').val(moment(info.end).format('LT').padStart(5, 0));
                $('#slt-proj').val('');
                $('#txt-desc').val('');
                $('#txt-cmnt').val('');
                $('#pkr-color').val(color);
                $('#aux-cod').val('');
                $('#pkr-ini').attr('readonly', false);
                $('#pkr-fin').attr('readonly', false);
                $('#slt-proj').attr('disabled', false);
                $('#txt-desc').attr('readonly', false);
                $('#txt-cmnt').attr('readonly', false);
                $('#pkr-color').attr('disabled', false);
                $('#btn-borrar').hide();
                $('#btn-editar').hide();
                $('#btn-agregar').show();
                project = null;
                $('#div-span-act').css('display', 'none');
                $('#mdl-activity').modal('show');
            }
            else {
                $('#txt-detalle').html('Lo sentimos, solo puede agregar actividades entre el primer día del mes y la fecha actual.');
                $('#mdl-message').modal('show');
            }
        },
        eventClick: (info) => {
            $('#txt-date').text(moment(info.event.start).format('dddd, DD [de] MMMM'));
            $('#aux-ini').val(moment(info.event.start).format());
            $('#aux-fin').val(moment(info.event.end).format());
            $('#pkr-ini').val(moment(info.event.start).format('LT').padStart(5, 0));
            $('#pkr-fin').val(moment(info.event.end).format('LT').padStart(5, 0));
            $('#txt-desc').val(info.event.extendedProps.description);
            $('#txt-cmnt').val(info.event.extendedProps.comment);
            $('#pkr-color').val(info.event.backgroundColor);
            $('#aux-cod').val(info.event.id);
            if (info.event.start < tmrrw && info.event.end < tmrrw && info.event.start.getMonth() == today.getMonth() &&
                (info.event.end.getMonth() == today.getMonth() || info.event.end.getMonth() == tmrrw.getMonth())) {
                $('#pkr-ini').attr('readonly', false);
                $('#pkr-fin').attr('readonly', false);
                $('#slt-proj').attr('disabled', false);
                $('#txt-desc').attr('readonly', false);
                $('#txt-cmnt').attr('readonly', false)
                $('#pkr-color').attr('disabled', false);
                $('#btn-borrar').show();
                $('#btn-editar').show();
            }
            else {
                $('#pkr-ini').attr('readonly', true);
                $('#pkr-fin').attr('readonly', true);
                $('#slt-proj').attr('disabled', true);
                $('#txt-desc').attr('readonly', true);
                $('#txt-cmnt').attr('readonly', true);
                $('#pkr-color').attr('disabled', true);
                $('#btn-borrar').hide();
                $('#btn-editar').hide();
            }
            $('#btn-agregar').hide();
            project = info.event.extendedProps.project;
            $('#div-span-act').css('display', 'none');
            $('#mdl-activity').modal('show');
        },
        eventResize: (info) => {
            if (info.event.start < tmrrw && info.event.end < tmrrw && info.event.start.getMonth() == today.getMonth() &&
                (info.event.end.getMonth() == today.getMonth() || info.event.end.getMonth() == tmrrw.getMonth())) {
                $('#aux-ini').val(moment(info.event.start).format());
                $('#aux-fin').val(moment(info.event.end).format());
                $('#pkr-ini').val(moment(info.event.start).format('LT').padStart(5, 0));
                $('#pkr-fin').val(moment(info.event.end).format('LT').padStart(5, 0));
                $('#txt-desc').val(info.event.extendedProps.description);
                $('#txt-cmnt').val(info.event.extendedProps.comment);
                $('#pkr-color').val(info.event.backgroundColor);
                $('#aux-cod').val(info.event.id);
                project = info.event.extendedProps.project;
                $('#btn-editar').click();
            }
            else {
                info.revert();
                $('#txt-detalle').html('Lo sentimos, solo puede redimensionar actividades dentro de las 24 horas del día.');
                $('#mdl-message').modal('show');
            }
        },
        eventDrop: (info) => { // event drag and drop
            if (info.oldEvent.start < tmrrw && info.oldEvent.end < tmrrw && info.oldEvent.start.getMonth() == today.getMonth() &&
                (info.oldEvent.end.getMonth() == today.getMonth() || info.oldEvent.end.getMonth() == tmrrw.getMonth()) &&
                (info.event.start < tmrrw && info.event.end < tmrrw && info.event.start.getMonth() == today.getMonth()) &&
                (info.event.end.getMonth() == today.getMonth() || info.event.end.getMonth() == tmrrw.getMonth())) {
                $('#aux-ini').val(moment(info.event.start).format());
                $('#aux-fin').val(moment(info.event.end).format());
                $('#pkr-ini').val(moment(info.event.start).format('LT').padStart(5, 0));
                $('#pkr-fin').val(moment(info.event.end).format('LT').padStart(5, 0));
                $('#txt-desc').val(info.event.extendedProps.description);
                $('#txt-cmnt').val(info.event.extendedProps.comment);
                $('#pkr-color').val(info.event.backgroundColor);
                $('#aux-cod').val(info.event.id);
                project = info.event.extendedProps.project;
                $('#btn-editar').click();
            }
            else {
                info.revert();
                $('#txt-detalle').html('Lo sentimos, solo puede mover actividades entre el primer día del mes y la fecha actual.');
                $('#mdl-message').modal('show');
            }
        }
    });
    
    /* 
     * Load activities to calendar
     */
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'loadActivities',
        success: (data) => {
            $(JSON.parse(data)).each(function() {
                calendar.addEvent({
                    id: this.id,
                    title: this.project.name + (this.project.code.substr(0,3) != 'OTR' ? separado + this.descr : ''),
                    start: this.start_time,
                    end: this.end_time,
                    description: this.description,
                    comment: this.comment,
                    backgroundColor: this.color,
                    project: this.project
                });
            });
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            $('#txt-detalle').html(msg.responseJSON['message']);
            $('#mdl-activity').modal('hide');
            $('#mdl-message').modal('show');
            $('body').loadingModal('destroy');
        }
    });
    calendar.render();

    /*
    * Load projects to select
    */
    $('#mdl-activity').on('show.bs.modal', () => {
        if (project) $('#slt-proj').val(project.id);
    });

    /* 
     * Load selected project
     */
    $('#slt-proj').change(() => { 
        $.ajax({
            type: 'get',
            url: 'getProject/' + $('#slt-proj').val(),
            success: (data) => {
                project = JSON.parse(data);
                if (project.code.substr(0,3) == 'OTR'){
                    $('#txt-desc').val('');
                    $('#txt-desc').prop('placeholder','No necesita descripción.');
                    $('#txt-desc').prop('disabled',true);
                }
                else{
                    $('#txt-desc').prop('placeholder','Descripción de la actividad');
                    $('#txt-desc').prop('disabled',false);
                }
            },
            error: (msg) => {
                $('#txt-detalle').html(msg.responseJSON['message']);
                $('#mdl-activity').modal('hide');
                $('#mdl-message').modal('show');
            }
        });
    });

    /* 
     * Add event submit 
     */
    $('#btn-agregar').click(() => {
        var hrIni = $('#pkr-ini').val().trim();
        var hrFin = $('#pkr-fin').val().trim();
        var start = $('#aux-ini').val().substr(0, 10) + ' ' + hrIni + ':00';
        var final = $('#aux-fin').val().substr(0, 10) + ' ' + hrFin + ':00';
        var descr = $('#txt-desc').val().trim();
        var cmmnt = $('#txt-cmnt').val().trim();
        var color = $('#pkr-color').val().trim();
        var isPrj = project.code.substr(0,3) != 'OTR';

        if (hrIni && hrFin && start < final && project && (descr || !isPrj)) {
            $('body').loadingModal({
                text:'Un momento, por favor...',
                animation:'wanderingCubes'
            });
            $.ajax({
                type: 'post',
                url: 'insertActivity',
                data: {
                    'project_id': project.id,
                    'start_time': start,
                    'end_time': final,
                    'description': descr,
                    'comment': cmmnt,
                    'color': color
                },
                success: (data) => {
                    calendar.addEvent({
                        id: data.id,
                        title: project.name + (isPrj ? separado + descr : ''),
                        start: new Date(start),
                        end: new Date(final),
                        description: descr,
                        comment: cmmnt,
                        backgroundColor: color,
                        project: project
                    });
                    $('#mdl-activity').modal('hide');
                    $('body').loadingModal('destroy');
                },
                error: (msg) => {
                    $('#txt-detalle').html(msg.responseJSON['message']);
                    $('#mdl-message').modal('show');
                    $('#mdl-activity').modal('hide');
                    $('body').loadingModal('destroy');
                }
            });
        }
        else {
            $('#msg-span-act').empty();
            if (!hrIni || !hrFin) $('#msg-span-act').append('<li>Debes ingresar el inicio y término de la actividad.</li>');
            if (start >= final) $('#msg-span-act').append('<li>La hora de inicio debe ser menor a la hora final.</li>');
            if (!project) $('#msg-span-act').append('<li>Debes seleccionar un proyecto.</li>');
            if (isPrj && !descr) $('#msg-span-act').append('<li>Debes ingresar una descripción de la actividad.</li>');
            $('#div-span-act').css('display', 'block');
        }
    });

    /* 
     * Update event submit
     */
    $('#btn-editar').click(() => {
        var codex = $('#aux-cod').val();
        var hrIni = $('#pkr-ini').val().trim();
        var hrFin = $('#pkr-fin').val().trim();
        var start = $('#aux-ini').val().substr(0, 10) + ' ' + hrIni + ':00';
        var final = $('#aux-fin').val().substr(0, 10) + ' ' + hrFin + ':00';
        var descr = $('#txt-desc').val().trim();
        var cmmnt = $('#txt-cmnt').val().trim();
        var color = $('#pkr-color').val().trim();
        var isPrj = project.code.substr(0,3) != 'OTR';

        if (hrIni && hrFin && start < final && project && (descr || !isPrj)) {
            $('body').loadingModal({
                text:'Un momento, por favor...',
                animation:'wanderingCubes'
            });
            $.ajax({
                type: 'post',
                url: 'updateActivity',
                data: {
                    'id':codex,
                    'project_id': project.id,
                    'start_time': start,
                    'end_time': final,
                    'description': descr,
                    'comment': cmmnt,
                    'color': color
                },
                success: function (data) {
                    calendar.getEventById(codex).remove();
                    calendar.addEvent({
                        id: codex,
                        title: project.name + (isPrj ? separado + descr : ''),
                        start: new Date(start),
                        end: new Date(final),
                        description: descr,
                        comment: cmmnt,
                        backgroundColor: color,
                        project: project
                    });
                    $('#mdl-activity').modal('hide');
                    $('body').loadingModal('destroy');
                },
                error: (msg) => {
                    $('#txt-detalle').html(msg);
                    $('#mdl-message').modal('show');
                    $('#mdl-activity').modal('hide');
                    $('body').loadingModal('destroy');
                }
            });
        }
        else {
            $('#msg-span-act').empty();
            if (!hrIni || !hrFin) $('#msg-span-act').append('<li>Debes ingresar el inicio y término de la actividad.</li>');
            if (start >= final) $('#msg-span-act').append('<li>La hora de inicio debe ser menor a la hora final.</li>');
            if (!project) $('#msg-span-act').append('<li>Debes seleccionar un proyecto.</li>');
            if (isPrj && !descr) $('#msg-span-act').append('<li>Debes ingresar una descripción de la actividad.</li>');
            $('#div-span-act').css('display', 'block');
        }
    });
    
    /* 
     * Delete event clicked
     */
    $('#btn-borrar').click(() => {
        $('#txt-confirm').html('¿Realmente desea eliminar esta actividad?');
        $('#mdl-activity').modal('hide');
        $('#mdl-confirm').modal('show');
    });

    $('#btn-yes').click(() => {
        var code = $('#aux-cod').val();
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'post',
            url: 'deleteActivity/' + code,
            success: function (data) {
                if (data) {
                    calendar.getEventById(code).remove();
                }
                else {
                    $('#txt-detalle').html('Lo sentimos, no se pudo eliminar la actividad seleccionada. Vuelva a intentarlo en unos minutos. De persistir el problema, contacte al administrador del sistema.');
                    $('#mdl-message').modal('show');
                }
                $('#mdl-confirm').modal('hide');
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                $('#txt-detalle').html(msg.responseJSON['message']);
                $('#mdl-message').modal('show');
                $('#mdl-confirm').modal('hide');
                $('body').loadingModal('destroy');
            }
        });
    });

    $('#btn-no').click(() => {
        $('#mdl-confirm').modal('hide');
    });
});