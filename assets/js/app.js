$(document).ready(function() {
    // Smooth scrolling for navigation links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            const headerOffset = 80;
            const elementPosition = target.offset().top;
            const offsetPosition = elementPosition - headerOffset;

            $('html, body').animate({
                scrollTop: offsetPosition
            }, 800);
        }
    });

    // Active navigation highlighting
    $(window).on('scroll', function() {
        let current = '';
        const scrollPos = $(window).scrollTop();
        
        $('section[id]').each(function() {
            const sectionTop = $(this).offset().top - 100;
            if (scrollPos >= sectionTop) {
    
            }
        });

        $('.navbar-nav .nav-link').removeClass('active');
        $('.navbar-nav .nav-link[href="#' + current + '"]').addClass('active');
    });

    // Counter animation for stats
    function animateCounters() {
        $('.stat-number').each(function() {
            const $counter = $(this);
            const target = parseInt($counter.text().replace(/[^0-9]/g, ''));
            const suffix = $counter.text().replace(/[0-9]/g, '');
            let current = 0;
            const increment = target / 100;
            
            const timer = setInterval(function() {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                $counter.text(Math.floor(current) + suffix);
            }, 20);
        });
    }


        // --- Dokumen frontend: table search/fetch and preview modal (moved from view)
        (function () {
            // read URLs from server-rendered config
            var urls = (window.LPM && window.LPM.urls) || {};
            var input = document.getElementById('frontendDokumenSearch');
            var table = document.getElementById('dokumenTable');
            var tbody = table && table.querySelector('tbody');
            var emptyState = document.getElementById('dokumenEmptyState');

            function normalize(s) { return (s||'').toString().trim().toLowerCase(); }

            function filterRows(q) {
                var rows = tbody ? Array.from(tbody.querySelectorAll('tr')) : [];
                var visibleCount = 0;
                rows.forEach(function (tr) {
                    var title = normalize(tr.cells[0] && tr.cells[0].innerText);
                    var desc = normalize(tr.cells[1] && tr.cells[1].innerText);
                    var ok = q === '' || title.indexOf(q) !== -1 || desc.indexOf(q) !== -1;
                    tr.style.display = ok ? '' : 'none';
                    if (ok) visibleCount++;
                });
                if (emptyState) emptyState.style.display = visibleCount === 0 ? '' : 'none';
            }

            if (input) {
                input.addEventListener('input', function () { filterRows(normalize(this.value)); });
            }

            // If server didn't render rows, try fetching JSON from a conventional endpoint
            (function tryFetch() {
                if (!tbody) return;
                if (tbody.querySelectorAll('tr').length) return; // already has rows
                var url = urls.dokumenJson || '/dokumen/json';
                fetch(url, { credentials: 'same-origin' })
                    .then(function (res) {
                        if (!res.ok) throw new Error('Network response not ok');
                        return res.json();
                    })
                    .then(function (data) {
                        if (!Array.isArray(data) || data.length === 0) {
                            if (emptyState) emptyState.style.display = '';
                            return;
                        }
                        var frag = document.createDocumentFragment();
                        data.forEach(function (d) {
                            var tr = document.createElement('tr');
                            var titleTd = document.createElement('td');
                            titleTd.textContent = d.title || '';
                            var descTd = document.createElement('td');
                            descTd.className = 'd-none d-sm-table-cell text-muted small dokumen-desc';
                            descTd.textContent = (d.description || '').replace(/\s+/g,' ').slice(0,120) + (d.description && d.description.length>120 ? '...' : '');
                            var statusTd = document.createElement('td');
                            statusTd.innerHTML = (d.is_active ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Nonaktif</span>');
                            var dateTd = document.createElement('td');
                            dateTd.className = 'text-muted small';
                            dateTd.textContent = d.created_at ? new Date(d.created_at).toLocaleDateString() : '';
                            var actionsTd = document.createElement('td');
                            actionsTd.className = 'text-end';
                            var group = document.createElement('div'); group.className = 'btn-group'; group.role = 'group';
                            if (d.file_url) {
                                var btn = document.createElement('button'); btn.type = 'button'; btn.className = 'btn btn-sm btn-outline-secondary btn-preview'; btn.setAttribute('data-file', d.file_url); btn.textContent = 'Preview';
                                var a = document.createElement('a'); a.className = 'btn btn-sm btn-outline-primary'; a.href = d.file_url; a.target = '_blank'; a.rel = 'noopener'; a.textContent = 'Unduh';
                                group.appendChild(btn); group.appendChild(a);
                            } else {
                                var btnNo = document.createElement('button'); btnNo.className = 'btn btn-sm btn-outline-secondary'; btnNo.disabled = true; btnNo.textContent = 'Tidak ada file'; group.appendChild(btnNo);
                            }
                            var link = document.createElement('a'); link.className = 'btn btn-sm btn-outline-dark'; link.href = urls.dokumenIndex || '/dokumen'; link.textContent = 'Lihat'; group.appendChild(link);
                            actionsTd.appendChild(group);

                            tr.appendChild(titleTd);
                            tr.appendChild(descTd);
                            tr.appendChild(statusTd);
                            tr.appendChild(dateTd);
                            tr.appendChild(actionsTd);
                            frag.appendChild(tr);
                        });
                        tbody.appendChild(frag);
                        if (emptyState) emptyState.style.display = 'none';
                    })
                    .catch(function () {
                        if (emptyState) emptyState.style.display = '';
                    });
            })();

            // Delegated preview modal handler; ensure Bootstrap is available before initializing
            (function () {
                var modalEl = document.getElementById('dokumenPreviewModal');
                if (!modalEl) return;
                var container = document.getElementById('dokumenPreviewContainer');
                var downloadLink = document.getElementById('dokumenPreviewDownload');

                function isPDF(url) { return url.split('?')[0].toLowerCase().endsWith('.pdf'); }

                function initWithBootstrap() {
                    if (!window.bootstrap || !window.bootstrap.Modal) return;
                    if (window._dokumenPreviewInitialized) return;
                    window._dokumenPreviewInitialized = true;
                    var bsModal = new bootstrap.Modal(modalEl);

                    document.addEventListener('click', function (e) {
                        var btn = e.target.closest && e.target.closest('.btn-preview');
                        if (!btn) return;
                        var url = btn.getAttribute('data-file');
                        if (!url) return;
                        container.innerHTML = '';
                        downloadLink.href = url;
                        if (isPDF(url)) {
                            var iframe = document.createElement('iframe');
                            iframe.src = url;
                            iframe.style.width = '100%';
                            iframe.style.height = '70vh';
                            iframe.setAttribute('frameborder', '0');
                            container.appendChild(iframe);
                        } else {
                            var box = document.createElement('div');
                            box.className = 'text-center py-4';
                            box.innerHTML = '<p class="mb-3">Preview tidak tersedia untuk tipe file ini.</p>' +
                                '<a class="btn btn-primary" href="' + url + '" target="_blank" rel="noopener">Unduh Dokumen</a>';
                            container.appendChild(box);
                        }
                        bsModal.show();
                    });

                    modalEl.addEventListener('hidden.bs.modal', function () {
                        container.innerHTML = '';
                        downloadLink.href = '#';
                    });
                }

                // If bootstrap is already loaded, init immediately
                if (window.bootstrap && window.bootstrap.Modal) {
                    initWithBootstrap();
                    return;
                }

                // Otherwise attempt to load local bootstrap bundle and initialize after load
                var loaderAttr = 'data-bootstrap-loader-dokumen';
                var existing = document.querySelector('script[' + loaderAttr + ']');
                if (existing) {
                    existing.addEventListener('load', initWithBootstrap);
                    existing.addEventListener('error', initWithBootstrap);
                    return;
                }

                var script = document.createElement('script');
                script.src = urls.bootstrapLocal || '/js/bootstrap.bundle.min.js';
                script.async = true;
                script.setAttribute(loaderAttr, '1');
                script.onload = initWithBootstrap;
                script.onerror = function () {
                    // If local load fails, try official CDN once, then give up
                    if (!window._dokumenBootstrapCDNAttempted) {
                        window._dokumenBootstrapCDNAttempted = true;
                        console.warn('Gagal memuat Bootstrap lokal, mencoba CDN...');
                        var cdn = document.createElement('script');
                        cdn.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js';
                        cdn.async = true;
                        cdn.onload = initWithBootstrap;
                        cdn.onerror = function () { console.warn('Gagal memuat Bootstrap dari CDN juga. Modal preview mungkin tidak berfungsi.'); initWithBootstrap(); };
                        document.head.appendChild(cdn);
                        return;
                    }
                    console.warn('Gagal memuat Bootstrap bundle. Modal preview mungkin tidak berfungsi.');
                    initWithBootstrap();
                };
                document.head.appendChild(script);
            })();

        })();
    // Trigger counter animation when stats section comes into view
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    } else {
        // Fallback for browsers without IntersectionObserver
        $(window).on('scroll', function() {
            const statsSection = $('.stats-section');
            if (statsSection.length) {
                const windowHeight = $(window).height();
                const scrollTop = $(window).scrollTop();
                const sectionTop = statsSection.offset().top;
                
                if (scrollTop + windowHeight > sectionTop && !statsSection.hasClass('animated')) {
                    statsSection.addClass('animated');
                    animateCounters();
                }
            }
        });
    }

    // Mobile menu close on link click
    $('.navbar-nav .nav-link').on('click', function() {
        $('.navbar-collapse').collapse('hide');
    });

    // Add smooth fade-in effect to service cards on scroll
    function fadeInOnScroll() {
        $('.service-card').each(function() {
            const cardTop = $(this).offset().top;
            const cardBottom = cardTop + $(this).outerHeight();
            const windowTop = $(window).scrollTop();
            const windowBottom = windowTop + $(window).height();

            if (cardBottom >= windowTop && cardTop <= windowBottom) {
                $(this).addClass('fade-in');
            }
        });
    }

    $(window).on('scroll', fadeInOnScroll);
    fadeInOnScroll(); // Run once on page load

    // Navbar background opacity on scroll
    $(window).on('scroll', function() {
        const scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $('.navbar').addClass('scrolled');
        } else {
            $('.navbar').removeClass('scrolled');
        }
    });


//setting modal create

    $('#btnAddSetting').on('click', function() {
        let url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.html) {
                    var modalContainer = $('<div class="modal fade" id="modalCreateSetting" tabindex="-1" aria-labelledby="modalCreateSettingLabel" aria-hidden="true"></div>');
                    modalContainer.html(response.html);
                    $('body').append(modalContainer);
                    var modal = new bootstrap.Modal(document.getElementById('modalCreateSetting'));
                    modal.show();
                    modalContainer.on('hidden.bs.modal', function () {
                        modalContainer.remove();
                    });
                }
            },
            error: function() {
                alert('Gagal memuat formulir. Silakan coba lagi.');
            }
        });
    }); 

    $(document).on('click','#table-setting .btn-edit-setting', function() {
        let url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.html) {
                    $('#modalSetting').html(response.html).modal('show');
                }
            }
            });
    });

    $(document).on('click','#table-setting .btn-delete-setting', function() {
        let url = $(this).data('url');
        swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this setting!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(response.message, {
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error deleting setting: " + response.message, {
                                icon: "error",
                            });
                        }
                    }
                });
            }
        });
    });

});

// DataTable initialization for dokumenTable with search and export hookup
$(function () {
    if (typeof jQuery === 'undefined' || typeof jQuery.fn.dataTable === 'undefined') return;
    var tableSelector = '#dokumenTable';
    if (!$(tableSelector).length) return;

    // Destroy existing instance if any (safe re-init)
    if ($.fn.dataTable.isDataTable(tableSelector)) {
        $(tableSelector).DataTable().destroy();
    }

    var dt = $(tableSelector).DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: -1 }
        ]
    });

   

    // Replace any existing export handlers and provide CSV export of visible rows
    $('#btnExport').off('click.dokumenExport').on('click.dokumenExport', function () {
        var csv = [];
        var headers = [];
        $(tableSelector + ' thead th').each(function () {
            headers.push('"' + $(this).text().trim().replace(/"/g, '""') + '"');
        });
        csv.push(headers.join(','));

        dt.rows({ search: 'applied' }).nodes().each(function (node) {
            var row = [];
            $(node).find('td').each(function () {
                var text = $(this).text().trim().replace(/\n/g, ' ').replace(/\r/g, '').replace(/"/g, '""');
                row.push('"' + text + '"');
            });
            if (row.length) csv.push(row.join(','));
        });

        var csvString = csv.join('\n');
        var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
        if (navigator.msSaveBlob) {
            navigator.msSaveBlob(blob, 'dokumen_export.csv');
        } else {
            var link = document.createElement('a');
            if (link.download !== undefined) {
                var url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', 'dokumen_export.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    });

});
