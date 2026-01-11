# 🍽️ Reserva Gourmet - Sistema de Gestão (SGFP)

Este é um sistema completo de gestão de reservas para restaurantes, desenvolvido em **PHP** e **MySQL**. O projeto foi desenhado para oferecer uma experiência premium ao utilizador e uma ferramenta de controlo poderosa para o administrador.

## 🚀 Funcionalidades Principais

### Para Clientes:
- **Reserva Inteligente:** Formulário com seleção de restaurante e número de pessoas.
- **Prevenção de Overbooking:** O sistema valida a lotação máxima em tempo real antes de confirmar.
- **Janela de Tempo:** Reservas automáticas com slots de 2 horas.
- **Consulta Dinâmica:** Filtro de data para verificar disponibilidade em dias futuros.

### Para Administradores:
- **Dashboard de Gestão:** Visualização centralizada de todas as reservas por data.
- **Sistema de Check-in:** Controlo de presença dos clientes (Status: Pendente/Concluído).
- **Analytics:** Gráficos de barras (Chart.js) que mostram a popularidade de cada local.
- **Segurança:** Área administrativa protegida por sessão.
- **Relatórios:** Exportação da lista de reservas para PDF pronta a imprimir.

## 🛠️ Tecnologias Utilizadas
- **Backend:** PHP 8.x
- **Base de Dados:** MySQL
- **Frontend:** Bootstrap 5, Google Fonts (Playfair Display & Poppins)
- **Gráficos:** Chart.js

## 📦 Como Instalar e Testar

1. **Base de Dados:**
   - Importe o ficheiro `database.sql` incluído neste repositório para o seu servidor MySQL (phpMyAdmin).
   
2. **Configuração:**
   - Ajuste as credenciais no ficheiro `config.php` (host, user, pass, dbname).

3. **Dados de Teste:**
   - Execute o ficheiro `simular.php` no seu browser para gerar automaticamente 20 reservas fictícias e ver os gráficos em funcionamento.

4. **Acesso Admin:**
   - **Utilizador:** `admin@gourmet.pt`
   - **Password:** (Definida no script de simulação ou manualmente na DB)

## 📸 Demonstração da Estrutura
O sistema utiliza uma arquitetura MVC simples (Model-View-Controller) para separar a lógica de reserva da interface visual.

---
Desenvolvido por [O TEU NOME AQUI]