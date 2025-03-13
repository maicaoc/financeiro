function ValidarMeusDados() {
  
  if ($("#nome").val().trim() == "") {
    alert("preencher o campo obrigatorio NOME");
    $("#nome").focus();
    return false;
  }
  
  
  if ($("#email").val().trim() == "") {
    alert("preencher o campo obrigatorio EMAIL");
    $("#email").focus();
    return false;
  }
  
  if ($("#senha").val().trim() == "") {
    alert("preencher o campo obrigatorio SENHA");
    $("#senha").focus();
    return false;
  }

}

function ValidarCategoria() {
  if ($("#nome").val().trim() == "") {
    alert("preencher o campo obrigatorio CATEGORIA");
    $("#nome").focus();
    return false;
  }
}

function ValidarEmpresa() {
  if ($("#nome").val().trim() == "") {
    alert("preencher o campo obrigatorio EMPRESA");
    $("#nome").focus();
    return false;
  }

  if ($("#telefone").val().trim() == "") {
    alert("preencher o campo obrigatorio TELEFONE");
    $("#telefone").focus();
    return false;
  }

  if ($("#endereco").val().trim() == "") {
    alert("preencher o campo obrigatorio ENDEREÇO");
    $("#endereco").focus();
    return false;
  }
}

function Validarconta() {
  if ($("#banco").val().trim() == "") {
    alert("preencher o campo obrigatorio BANCO");
    $("#banco").focus();
    return false;
  }

  if ($("#agencia").val().trim() == "") {
    alert("preencher o campo obrigatorio AGENCIA");
    $("#agencia").focus();
    return false;
  }

  if ($("#numero").val().trim() == "") {
    alert("preencher o campo obrigatorio NUMERO");
    $("#numero").focus();
    return false;
  }

  if ($("#saldo").val().trim() == "") {
    alert("preencher o campo obrigatorio SALDO");
    $("#saldo").focus();
    return false;
  }
}

function RealizarMovimento() {
  if ($("#tipo").val().trim() == "") {
    alert("preencher o campo obrigatorio TIPO");
    $("#tipo").focus();
    return false;
  }

  if ($("#data").val().trim() == "") {
    alert("preencher o campo obrigatorio DATA");
    $("#data").focus();
    return false;
  }

  if ($("#valor").val().trim() == "") {
    alert("preencher o campo obrigatorio VALOR");
    $("#valor").focus();
    return false;
  }

  if ($("#categoria").val().trim() == "") {
    alert("preencher o campo obrigatorio CATEGORIA");
    $("#categoria").focus();
    return false;
  }

  if ($("#empresa").val().trim() == "") {
    alert("preencher o campo obrigatorio EMPRESA");
    $("#empresa").focus();
    return false;
  }

  if ($("#conta").val().trim() == "") {
    alert("preencher o campo obrigatorio CONTA");
    $("#conta").focus();
    return false;
  }
}

function ConsultarMovimento() {
  if ($("#datainicial").val().trim() == "") {
    alert("preencher o campo obrigatorio DATA INICIAL");
    $("#datainicial").focus();
    return false;
  }

  if ($("#datafinal").val().trim() == "") {
    alert("preencher o campo obrigatorio DATA FINAL");
    $("#datafinal").focus();
    return false;
  }
}

function ValidarLogin() {
  if ($("#emailUsuario").val().trim() == "") {
    alert("preencher o campo obrigatorio EMAIL");
    $("#emailUsuario").focus();
    return false;
  }

  if ($("#senha").val().trim() == "") {
    alert("preencher o campo obrigatorio SENHA"); 
    $("#senha").focus();
    return false;
  }

 
}
function ValidarCadastro() {
  // Validação do campo "nome"
  if ($("#nome").val().trim() == "") {
    alert("Preencher o campo obrigatório NOME");
    $("#nome").focus();
    return false;
  }

  // Validação do campo "email"
  if ($("#email").val().trim() == "") {
    alert("Preencher o campo obrigatório EMAIL");
    $("#email").focus();
    return false;
  }

  // Validação do campo "senha"
  if ($("#senha").val().trim() == "") {
    alert("Preencher o campo obrigatório SENHA");
    $("#senha").focus();
    return false;
  }

  // Validação do campo "repSenha"
  if ($("#repSenha").val().trim() == "") {
    alert("Preencher o campo obrigatório CONFIRMAÇÃO DE SENHA");
    $("#repSenha").focus();
    return false;
  }

  // Verificações adicionais: senha e confirmação da senha
  if ($("#senha").val() !== $("#repSenha").val()) {
    alert("As senhas não coincidem");
    $("#repSenha").focus();
    return false;
  }

  // Se todas as validações passaram
  return true;
}