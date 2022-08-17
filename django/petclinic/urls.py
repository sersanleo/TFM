from django.contrib import admin
from django.contrib.auth.views import LoginView, LogoutView
from django.urls import include, path

from . import views
from .forms import LoginForm

urlpatterns = [
    path('admin/', admin.site.urls),
    path('pet/', include('pets.urls')),
    path('appointment/', include('appointments.urls')),
    path('api/', include('api.urls')),
    path('', views.index, name='index'),
    path('login/', LoginView.as_view(template_name='login.html',
         authentication_form=LoginForm, redirect_authenticated_user=True), name='login'),
    path('logout/', LogoutView.as_view(), name='logout'),
    path('register/', views.register, name='register'),
]
