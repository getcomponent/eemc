function deleteUser(id) {
    $.ajax({
        url: 'delete_user/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',
        data: {},
        success: function(data, status) {
            alert("Пользователь удален!");
            $('#user' + id).remove();
        }
    });
}

function deleteTest(id) {
    $.ajax({
        url: 'delete_test/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',
        data: {},
        success: function(data, status) {
            alert("Тест удален!");
            $('#test' + id).remove();
        }
    });
}

function viewTests(id) {
    $.ajax({
        url: 'view_tests/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',
        data: {},
        success: function(data, status) {
            $("#testsModal").modal('show');
            var s = `
                <table><tr>
                    <th width="200">Номер теста</th>
                    <th>Отметка</th></tr>
                    `;
            for (var i = data.length - 1; i >= 0; i--) {
                s += "<tr><td>" + data[i].test_id + "</td><td>" + data[i].mark + "</td></tr>";
            }
            s += "</table>";
            $("#testsModal .modal-body").html(s);
        }
    });
}

function addUser() {
    $.ajax({
        url: 'add_user',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',
        data: {
            name: $('#user_name').val(),
            password: $('#user_password').val(),
            group: $('#user_group').val(),
            email: $('#user_email').val()
        },
        success: function(data, status) {
            alert('Пользователь добавлен!');
        }
    });
}

function addDoc() {
    postForm('doc_form', function() {
        alert('Документ добавлен!');
    });
}

function deleteDoc(id) {
    $.ajax({
        url: 'delete_doc/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        method: 'POST',
        data: {},
        success: function(data, status) {
            alert("Документ удален!");
            $('#doc' + id).remove();
        }
    });
}

function openDoc(id) {
    var name = $("#doc" + id).children().eq(1).text();
    var description = $("#doc" + id).children().eq(2).text();
    var section = $("#doc" + id).children().eq(3).attr("id");
    $("#change_doc_form input[name='name']").val(name);
    $("#change_doc_form textarea[name='description']").val(description);
    $("#change_doc_form select").val(section);
    $("#change_doc_form #change_doc").removeAttr('onclick');
    $("#change_doc_form #change_doc").attr('onClick', 'changeDoc(' + id + ');');
    $("#myModal").modal('show');
}

function openUser(id) {
    var name = $("#u" + id).children().eq(0).text();
    var group = $("#u" + id).children().eq(1).text();
    var status = $("#u" + id).children().eq(2).text();

    $("#change_user_form input[name='name']").val(name);
    $("#change_user_form input[name='group']").val(group);
    $("#change_user_form input[name='status']").val(status);
    $("#change_user_form #change_user").removeAttr('onclick');
    $("#change_user_form #change_user").attr('onClick', 'changeUser(' + id + ');');
    $("#changeUserModal").modal('show');
}

function changeDoc(id) {
    var form = document.getElementById('change_doc_form');
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'change_doc/' + id, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    xhr.addEventListener("load", function() {
        if (xhr.status == 200) {
            alert("Документ изменен!");
            $("#myModal").modal('hide');
        }
    });
    xhr.send(formData);
}

function changeUser(id) {
    var form = document.getElementById('change_user_form');
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'change_user/' + id, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    xhr.addEventListener("load", function() {
        if (xhr.status == 200) {
            alert("Пользователь изменен!");
            $("#changeUserModal").modal('hide');
        }
    });
    xhr.send(formData);
}

function postForm(url, onLoad) {
    var form = document.getElementById('doc_form');
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_doc', true);
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    xhr.addEventListener("load", function() {
        if (xhr.status == 200) {
            onLoad();
        }
    });
    xhr.send(formData);
}

$(document).ready(function() {
    $(document).on("click", ".add_answer", addAnswer);
});

function addQuestion() {
    $('#questions').append(`
        <div class="question" style="margin-top: 50px; margin-bottom: 50px;">
            <p>Текст вопроса: <input type="text" name="question[][text]"></p>
            <div id="answers">
            </div>
            <input type="button" class="add_answer" value="Добавить ответ">
        </div>
        `);
}

function addAnswer() {
    var q = $(this).closest('.question');
    var question = q.index();
    var answer = q.find('#answers').children().length;
    q.find('#answers').append(`
        <div>
            <p>
                <input type="checkbox" name="question[${question}][answers][${answer}][is_correct]" value="y">
                <input type="text" name="question[${question}][answers][${answer}][text]">
            </p>
        </div>
        `);
}
