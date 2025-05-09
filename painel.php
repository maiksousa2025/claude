<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

include('conexao.php');

// Busca informações do usuário logado
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT nome FROM usuarios WHERE id = '$id_usuario'";
$result = mysqli_query($mysqli, $sql);
$usuario = mysqli_fetch_assoc($result);

// Conta o número de clientes cadastrados
$sql_count = "SELECT COUNT(*) as total FROM clientes";
$result_count = mysqli_query($mysqli, $sql_count);
$total_clientes = mysqli_fetch_assoc($result_count)['total'];

// Busca os últimos clientes cadastrados
$sql_recentes = "SELECT * FROM clientes ORDER BY id DESC LIMIT 5";
$result_recentes = mysqli_query($mysqli, $sql_recentes);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Sistema de Gerenciamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #4e73df;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            color: white;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        .nav-link:hover {
            color: white !important;
        }
        .dropdown-menu {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #4e73df;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-link:hover {
            background-color: #3a5cbe;
            color: white;
        }
        .sidebar-link i {
            margin-right: 0.75rem;
            width: 24px;
            text-align: center;
        }
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e3e6f0;
            font-weight: bold;
        }
        .stats-card {
            background-color: #4e73df;
            color: white;
        }
        .stats-icon {
            font-size: 2rem;
            opacity: 0.4;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .active-sidebar-link {
            background-color: #3a5cbe;
            color: white;
            font-weight: bold;
        }
        .page-title {
            margin-bottom: 1.5rem;
            font-weight: bold;
            color: #5a5c69;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="painel.php">
                <i class="fas fa-tasks me-2"></i>
                Sistema MPHP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <?php echo $usuario['nome']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm me-2"></i>Meu Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm me-2"></i>Configurações</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm me-2"></i>Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0">
                <div class="sidebar">
                    <a href="painel.php" class="sidebar-link active-sidebar-link">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                    <a href="clientes.php" class="sidebar-link">
                        <i class="fas fa-users"></i>Clientes
                    </a>
                    <a href="cadastro_cliente.php" class="sidebar-link">
                        <i class="fas fa-user-plus"></i>Novo Cliente
                    </a>
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-chart-bar"></i>Relatórios
                    </a>
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-cog"></i>Configurações
                    </a>
                    <a href="logout.php" class="sidebar-link">
                        <i class="fas fa-sign-out-alt"></i>Sair
                    </a>
                </div>
            </div>
            
            <!-- Conteúdo -->
            <div class="col-md-9 col-lg-10 p-4">
                <h1 class="page-title">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </h1>
                
                <!-- Cards informativos -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card stats-card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-uppercase mb-1">Total de Clientes</div>
                                        <div class="h5 mb-0 font-weight-bold"><?php echo $total_clientes; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users stats-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stats-card h-100" style="background-color: #1cc88a;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-uppercase mb-1">Clientes Ativos</div>
                                        <div class="h5 mb-0 font-weight-bold">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-check stats-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stats-card h-100" style="background-color: #36b9cc;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-uppercase mb-1">Novos este mês</div>
                                        <div class="h5 mb-0 font-weight-bold">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar stats-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card stats-card h-100" style="background-color: #f6c23e;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-uppercase mb-1">Pendentes</div>
                                        <div class="h5 mb-0 font-weight-bold">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock stats-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Últimos clientes -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="m-0 font-weight-bold">Últimos Clientes Cadastrados</h6>
                                <a href="clientes.php" class="btn btn-sm btn-primary">
                                    <i class="fas fa-users me-1"></i>Ver Todos
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Data de Cadastro</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(mysqli_num_rows($result_recentes) > 0): ?>
                                                <?php while($cliente = mysqli_fetch_assoc($result_recentes)): ?>
                                                    <tr>
                                                        <td><?php echo $cliente['id']; ?></td>
                                                        <td><?php echo $cliente['nome']; ?></td>
                                                        <td><?php echo $cliente['email']; ?></td>
                                                        <td><?php echo $cliente['telefone']; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($cliente['data_cadastro'])); ?></td>
                                                        <td>
                                                            <a href="visualizar_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente?');">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Nenhum cliente cadastrado ainda.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Informações adicionais -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">Informações do Sistema</h6>
                            </div>
                            <div class="card-body">
                                <p>Bem-vindo ao Sistema de Gerenciamento de Clientes MPHP.</p>
                                <p>Use o menu lateral para navegar entre as diferentes funcionalidades do sistema.</p>
                                <p>Para cadastrar um novo cliente, clique em "Novo Cliente" no menu lateral.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold">Ações Rápidas</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="cadastro_cliente.php" class="btn btn-primary">
                                        <i class="fas fa-user-plus me-1"></i>Cadastrar Novo Cliente
                                    </a>
                                    <a href="clientes.php" class="btn btn-info text-white">
                                        <i class="fas fa-search me-1"></i>Buscar Clientes
                                    </a>
                                    <a href="#" class="btn btn-success">
                                        <i class="fas fa-file-export me-1"></i>Exportar Dados
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>










