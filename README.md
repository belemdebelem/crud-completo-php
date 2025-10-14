# crud-completo-php
CRUD Completo (Criar, Ler, Atualizar e Deletar) de usuários desenvolvido em HTML, CSS, Javascript e PHP. O projeto conecta-se ao MySQL usando a extensão mysqli, mostrando proficiência na implementação de lógica backend e persistência de dados. Utilizei servidor local como o XAMPP (configuração localhost) para o ambiente de desenvolvimento.
1. Tecnologias e Configuração do Ambiente
O projeto utiliza PHP para a lógica backend e interação com o banco de dados.
Conexão ao Banco de Dados (MySQL)
A conexão com o banco de dados MySQL é estabelecida através da extensão MySQLi. As configurações são definidas no arquivo conexao.php, utilizando o ambiente de servidor local (localhost).
Os parâmetros de conexão definidos são:
• Host: "localhost".
• Usuário: "root".
• Senha: "" (vazia).
• Banco de Dados: "crud" (nome sugerido para o banco de dados).
O código implementa uma checagem para garantir que a conexão não falhou, usando $conexao->connect_error e encerrando o processo (die) caso haja um erro.
Gestão de Estado
O projeto faz uso intensivo de variáveis de sessão (session_start()) para manter o estado e exibir mensagens de feedback ao usuário. Mensagens de sucesso ou falha, como "Usuário criado com sucesso" ou "Usuário não foi atualizado", são armazenadas na variável $_SESSION['mensagem']. Após a exibição, essas mensagens são desconfiguradas (unset($_SESSION['mensagem'])).

--------------------------------------------------------------------------------
2. Implementação das Operações CRUD
C: Criação (Create)
A criação de um novo usuário é realizada através de um formulário (usuario-create.php).
1. Formulário de Entrada: O formulário solicita informações cruciais do usuário, como Nome, Email, Data de Nascimento, e Senha.
2. Processamento: A lógica de criação é ativada quando a variável $_POST['create_usuario'] é definida.
3. Segurança dos Dados: Antes de executar a inserção, todas as strings de entrada (nome, email, data de nascimento) são higienizadas utilizando mysqli_real_escape_string() para prevenir ataques de injeção SQL.
4. Armazenamento de Senha: A senha fornecida é armazenada de forma segura, sendo convertida em um hash utilizando a função password_hash (trim($_POST['senha']), PASSWORD_DEFAULT).
5. SQL: O comando SQL para inserção é INSERT INTO usuarios(nome, email, data_nascimento, senha) VALUES (...).
6. Confirmação: O sucesso da operação é verificado através de mysqli_affected_rows($conexao) > 0. Em caso de sucesso, o usuário é redirecionado (header('Location: index.php')) e uma mensagem de sucesso é registrada na sessão.
R: Leitura (Read)
A operação de leitura ocorre em dois níveis: listagem geral e visualização detalhada.
1. Listagem de Usuários: A página principal (index.php) exibe uma Lista de Usuários. O comando SQL utilizado é SELECT * FROM usuarios. O resultado é processado, e se houver linhas (mysqli_num_rows($usuarios) > 0), os dados (ID, Nome, Email, Data Nascimento) são listados.
2. Visualização Detalhada: É possível visualizar um usuário individualmente (usuario-view.php). Esta tela recupera os dados baseando-se no ID do usuário, que é passado via parâmetro GET ($_GET['id']). O script executa a query SELECT * FROM usuarios WHERE ID='$usuario_id' e exibe os detalhes do Nome, Email e Data Nascimento.
U: Atualização (Update)
A atualização é acionada pelo formulário de edição (usuario-edit.php).
1. Processamento: A lógica de atualização é executada quando $_POST['update_usuario'] é definida.
2. Higienização: O usuario_id, nome, email e data de nascimento são sanitizados.
3. Lógica de Senha: O projeto trata a atualização de senha de forma condicional. O hash da senha só é recalculado e incluído no query UPDATE se o campo da senha não estiver vazio (!empty($senha)), garantindo que a senha não seja sobrescrita com um valor vazio se o campo for deixado em branco.
4. SQL: O comando UPDATE é construído para modificar os campos e inclui a cláusula where ID = $usuario_id para garantir que apenas o registro correto seja alterado.
5. Confirmação: Semelhante à criação, a operação é confirmada por mysqli_affected_rows() e gera uma mensagem de sucesso ou falha na sessão, seguida de redirecionamento.
D: Exclusão (Delete)
A exclusão é acionada quando $_POST['delete_usuario'] é definido.
1. Processamento: O usuario_id a ser deletado é extraído.
2. SQL: O comando SQL executado é DELETE FROM usuarios WHERE id = $usuario_id.
3. Confirmação: Após a execução do query, é verificado se mais de 0 linhas foram afetadas (mysqli_affected_rows($conexao) > 0). Em caso afirmativo, uma mensagem de sucesso é registrada e o usuário é redirecionado para a lista principal.
