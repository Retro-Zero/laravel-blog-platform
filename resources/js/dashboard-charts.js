import Chart from 'chart.js/auto';

// Dashboard Charts
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard charts loading...');
    console.log('Chart data:', window.chartData);
    // Post Views Chart
    const viewsCtx = document.getElementById('postViewsChart');
    if (viewsCtx) {
        const viewsChart = new Chart(viewsCtx, {
            type: 'line',
            data: {
                labels: window.chartData?.postViews?.labels || [],
                datasets: [{
                    label: 'Post Views',
                    data: window.chartData?.postViews?.data || [],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.15)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    // Post Categories Chart
    const categoriesCtx = document.getElementById('postCategoriesChart');
    if (categoriesCtx) {
        const categoriesChart = new Chart(categoriesCtx, {
            type: 'doughnut',
            data: {
                labels: window.chartData?.postCategories?.labels || [],
                datasets: [{
                    data: window.chartData?.postCategories?.data || [],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.9)',
                        'rgba(147, 51, 234, 0.9)',
                        'rgba(16, 185, 129, 0.9)',
                        'rgba(245, 158, 11, 0.9)',
                        'rgba(239, 68, 68, 0.9)'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // Monthly Posts Chart
    const monthlyCtx = document.getElementById('monthlyPostsChart');
    if (monthlyCtx) {
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: window.chartData?.monthlyPosts?.labels || [],
                datasets: [{
                    label: 'Posts Published',
                    data: window.chartData?.monthlyPosts?.data || [],
                    backgroundColor: 'rgba(147, 51, 234, 0.9)',
                    borderRadius: 8,
                    borderSkipped: false,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }

    // Comments Activity Chart
    const commentsCtx = document.getElementById('commentsActivityChart');
    if (commentsCtx) {
        const commentsChart = new Chart(commentsCtx, {
            type: 'line',
            data: {
                labels: window.chartData?.commentsActivity?.labels || [],
                datasets: [{
                    label: 'Comments Received',
                    data: window.chartData?.commentsActivity?.data || [],
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.15)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.08)',
                            drawBorder: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: 'rgba(0, 0, 0, 0.6)',
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    }
}); 