	 // Valida campos do formulário de entrega (usuários já cadastrados)
	function valida_form() {
		if (document.form_login.login.value == "")
			{alert("Por favor, preencha o campo [Login].");
		form_login.login.focus();
		return false;
	}
	if (document.form_login.senha.value == "")
		{alert("Por favor, preencha o campo [Senha].");
	form_login.senha.focus();
	return false;
	}
	return true;
	}