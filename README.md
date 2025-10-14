# crud-completo-php
CRUD Completo (Criar, Ler, Atualizar e Deletar) de usuários desenvolvido em HTML, CSS, Javascript e PHP. O projeto conecta-se ao MySQL usando a extensão mysqli, mostrando proficiência na implementação de lógica backend e persistência de dados. Utilizei servidor local como o XAMPP (configuração localhost) para o ambiente de desenvolvimento.
1. Tecnologias e Configuração Essenciais
O sistema foi configurado para rodar em um ambiente de servidor local, como o XAMPP, utilizando localhost.
Conexão com o Banco de Dados
A comunicação com o banco de dados MySQL é realizada através da extensão MySQLi do PHP.
• O arquivo conexao.php define os parâmetros cruciais, sendo o host definido como "localhost", o usuario como "root", a senha vazia ("") e o banco de dados utilizado como "crud".
• O script estabelece a conexão e inclui uma checagem de erro ($conexao->connect_error), interrompendo a execução (die) caso a conexão falhe.
2. Fluxo e Funcionalidades do CRUD
O projeto gerencia a listagem e manipulação dos dados de usuários.
Criação e Visualização de Dados
A adição de novos usuários é feita por um formulário dedicado (usuario-create.php), que solicita Nome, Email, Data de Nascimento e Senha. A página principal (index.php) exibe a Lista de Usuários, mostrando o ID, Nome, Email e Data de Nascimento. É possível visualizar detalhes de um usuário específico (usuario-view.php) usando o ID passado via parâmetro GET.
Operações de Gestão
A lógica de backend permite as quatro operações principais:
1. Criação (Create): Insere novos registros na tabela usuarios.
2. Atualização (Update): Permite a modificação dos dados do usuário com base no seu ID.
3. Exclusão (Delete): Remove o registro do usuário.
4. Leitura (Read): Recupera e lista todos os usuários ou um usuário específico.
3. Segurança e Experiência do Usuário
O projeto incorpora elementos para garantir a integridade e segurança dos dados, além de fornecer feedback claro ao usuário:
• Sanitização de Dados: Antes de executar qualquer query de inserção ou atualização, as strings de entrada (como nome e email) são higienizadas utilizando mysqli_real_escape_string() para prevenir injeções SQL.
• Armazenamento Seguro de Senhas: As senhas fornecidas pelo usuário são convertidas em hash seguro utilizando a função password_hash() com o algoritmo PASSWORD_DEFAULT, antes de serem armazenadas no banco de dados.
• Gestão de Sessões: O estado do usuário é gerenciado com sessões (session_start()). Mensagens de feedback (seja de sucesso, como "Usuário criado com sucesso", ou de falha, como "Usuário não foi atualizado") são armazenadas na variável $_SESSION['mensagem']. Essas mensagens são exibidas e posteriormente desconfiguradas (unset($_SESSION['mensagem'])) para garantir que apareçam apenas uma vez.
A exclusão é acionada quando $_POST['delete_usuario'] é definido.
1. Processamento: O usuario_id a ser deletado é extraído.
2. SQL: O comando SQL executado é DELETE FROM usuarios WHERE id = $usuario_id.
3. Confirmação: Após a execução do query, é verificado se mais de 0 linhas foram afetadas (mysqli_affected_rows($conexao) > 0). Em caso afirmativo, uma mensagem de sucesso é registrada e o usuário é redirecionado para a lista principal.
