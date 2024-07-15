$(document).ready(function() 
{
    $('#loginBtn').click(function() 
    {
      $('#loginModal').modal('show');
    });

    $('#registerBtn').click(function()
    {
      $('#registerModal').modal('show');
    });

    $('#logoutBtn').click(function()
    {
      $('#logoutModal').modal('show');
    });
});

document.getElementById('navbar-toggler').addEventListener('click', function() 
{
  this.classList.toggle('collapsed');
  document.getElementById('sidebar').classList.toggle('active');
});