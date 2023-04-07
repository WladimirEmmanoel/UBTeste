$(document).ready(function() {

  //Mascara de CPF
  function mascararCPF(campo) {

    campo.val(campo.val().replace(/\D/g, '')); // Remove caracteres não numéricos
    
    campo.val(campo.val().replace(/(\d{3})(\d)/, '$1.$2')); // Insere o primeiro ponto
    campo.val(campo.val().replace(/(\d{3})(\d)/, '$1.$2')); // Insere o segundo ponto
    campo.val(campo.val().replace(/(\d{3})(\d{1,2})$/, '$1-$2')); // Insere o hífen
    
    // Limita a quantidade de caracteres a 14 (incluindo pontos e hífen)
    if (campo.val().length = 14) {
      campo.val(campo.val().substr(0, 14));
    }
  }

  // Adicione um evento de escuta de entrada no campo de formulário
  $('#cpf').on('input', function(event) {
    mascararCPF($(event.target));
  });

  //FORMULÁRIO DE LOGIN
  $('#form-login').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: '/login',
        type: 'POST',
        data: formData,
        success: function(response) {
          if (response.success) {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-success');
            setTimeout(function() {
              window.location.href = '/dashboard';
            }, 3000); 
          } else {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-error');
            setTimeout(function() {
              $('#mensagem').removeClass('alert-error');
            }, 3000);
          }
        },
        error: function(response) {
          $('#mensagem').text(response.responseJSON.message);
          $('#mensagem').addClass('alert-error');
          setTimeout(function() {
            $('#mensagem').removeClass('alert-error');
          }, 3000);
        }
    });
  });

  //FORMULÁRIO DE CADASTRO
  $('#form-cadastro').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();
    var formulario = document.getElementById("form-cadastro");

    $.ajax({
        url: '/cadastrar',
        type: 'POST',
        data: formData,
        success: function(response) {
          if (response.success) {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-success');
            setTimeout(function() {
              $('#mensagem').removeClass('alert-success');
            }, 3000);
            formulario.reset();
          } else {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-error');
            setTimeout(function() {
              $('#mensagem').removeClass('alert-error');
            }, 3000);
          }
        },
        error: function(response) {
          $('#mensagem').text(response.responseJSON.message);
          $('#mensagem').addClass('alert-error');
          setTimeout(function() {
            $('#mensagem').removeClass('alert-error');
          }, 3000);
        },
    });
  });

  //FORMULÁRIO DE ALTERAÇÃO DE SENHA
  $('#form-change-password').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: '/alterar_senha',
        type: 'POST',
        data: formData,
        success: function(response) {
          $('#mensagem').text(response.message);
          $('#mensagem').addClass('alert-success');
          setTimeout(function() {
            window.location.href = '/dashboard';
          }, 3000); 
        },
        error: function(response) {
          $('#mensagem').text(response.responseJSON.message);
          $('#mensagem').addClass('alert-error');
          setTimeout(function() {
            $('#mensagem').removeClass('alert-error');
          }, 3000);
        },
    });
  });

  //FORMULÁRIO DE RECUPERAÇÃO DE SENHA
  $('#form-recover-password').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var formulario = document.getElementById("form-recover-password");

    $.ajax({
        url: '/recuperar_senha',
        type: 'POST',
        data: formData,
        success: function(response) {
          if (response.success) {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-success');
            setTimeout(function() {
              $('#mensagem').removeClass('alert-success');
            }, 3000);
            formulario.reset();
          } else {
            $('#mensagem').text(response.message);
            $('#mensagem').addClass('alert-error');
            setTimeout(function() {
              $('#mensagem').removeClass('alert-error');
            }, 3000);
          }
        },
        error: function(response) {
          $('#mensagem').text(response.responseJSON.message);
          $('#mensagem').addClass('alert-error');
          setTimeout(function() {
            $('#mensagem').removeClass('alert-error');
          }, 3000); 
        },
    });
  });

});