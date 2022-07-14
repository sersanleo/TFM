from django.contrib import admin
from django.urls import include, path

from . import views
urlpatterns = [
    path('admin/', admin.site.urls),
    path('pet/', include('pets.urls'), name='pets'),
    path('', views.index, name='index'),
    path('login/', views.login_view, name='login'),
    path('logout/', views.logout_view, name='logout'),
    path('register/', views.register, name='register'),
]
