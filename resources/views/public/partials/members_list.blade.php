@if($members->count() > 0)
    <div id="members-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:1.75rem; margin-top:1.5rem;">
        @foreach($members as $member)
            <div class="member-card" style="background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%); border: 2px solid #DAA520; border-radius: 16px; padding:1.75rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);"
                 onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 35px rgba(218, 165, 32, 0.25)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.5)';">
                
                <!-- Accent bar -->
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #DAA520, #FFD700); opacity: 0.8;"></div>
                
                <!-- Background decoration -->
                <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: radial-gradient(circle, rgba(218, 165, 32, 0.1) 0%, rgba(218, 165, 32, 0) 70%); border-radius: 50%;"></div>
                
                <div style="position: relative; z-index: 1;">
                    <!-- Avatar -->
                    <div style="width:80px; height:80px; background: linear-gradient(135deg, #DAA520 0%, #FFD700 100%); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:40px; margin-bottom:1.25rem; box-shadow: 0 6px 20px rgba(218, 165, 32, 0.35);">
                        👤
                    </div>
                    
                    <!-- Name -->
                    <h4 style="margin:0 0 0.75rem 0; color:#fff; font-size:1.15rem; font-weight:700; line-height:1.3;">{{ $member->full_name }}</h4>
                    
                    <!-- Grade/Class -->
                    <div style="color:#DAA520; font-weight:600; margin-bottom:0.75rem; font-size:0.95rem;">{{ $member->grade_class ?? '-' }}</div>
                    
                    <!-- Position badge -->
                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1rem;">
                        <span class="badge badge-info" style="background: linear-gradient(135deg, #DAA520, #FFD700); color:#000; font-weight:600; padding: 0.4rem 0.75rem; border-radius: 20px; font-size: 0.85rem;">{{ $member->position ?? '-' }}</span>
                    </div>
                    
                    <!-- Coach/Pembina -->
                    @if($member->coach)
                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1rem;">
                            <span class="badge badge-info" style="background: linear-gradient(135deg, #4a90e2, #357ae8); color:#fff; font-weight:600; padding: 0.4rem 0.75rem; border-radius: 20px; font-size: 0.85rem;">👨‍🏫 {{ $member->coach->name }}</span>
                        </div>
                    @endif
                    
                    <!-- Divider -->
                    <div style="border-top: 1px solid rgba(218, 165, 32, 0.2); padding-top:1rem; margin-top:1rem;">
                        <div style="color:#999; font-size:0.9rem; display: flex; justify-content: space-between; align-items: center;">
                            <span>NISN</span>
                            <span style="color:#DAA520; font-weight:700;">{{ $member->nisn ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination block (modern gold theme) --}}
    @if($members->hasPages())
        <div id="members-pager" class="pagination-wrapper" style="margin-top:2.5rem; padding:2rem 0;">
            <div style="display:flex; justify-content:center; align-items:center; gap:0.75rem; flex-wrap:wrap;">
                {{-- Previous --}}
                @if($members->onFirstPage())
                    <span style="padding:0.6rem 1.2rem; background:#333; color:#666; border-radius:8px; cursor:default; font-weight:600; font-size:0.95rem; opacity:0.5;">&laquo; Previous</span>
                @else
                    <a href="{{ $members->previousPageUrl() }}" class="ajax-page" style="padding:0.6rem 1.2rem; background:linear-gradient(135deg, #DAA520, #FFD700); color:#000; border-radius:8px; font-weight:600; font-size:0.95rem; text-decoration:none; transition:all 0.3s ease; display:inline-block;" 
                       onmouseover="this.style.boxShadow='0 6px 20px rgba(218, 165, 32, 0.4)'; this.style.transform='translateY(-2px)';"
                       onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">&laquo; Previous</a>
                @endif

                {{-- First page and ellipsis --}}
                @php
                    $current = $members->currentPage();
                    $last = $members->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $members->url(1) }}" class="ajax-page" style="min-width:40px; padding:0.6rem 0.8rem; background:#222; color:#DAA520; border:2px solid #DAA520; border-radius:8px; text-align:center; font-weight:600; text-decoration:none; transition:all 0.3s ease; display:inline-block;"
                       onmouseover="this.style.background='#DAA520'; this.style.color='#000';"
                       onmouseout="this.style.background='#222'; this.style.color='#DAA520';">1</a>
                    @if($start > 2)
                        <span style="color:#999; font-weight:600;">…</span>
                    @endif
                @endif

                {{-- Page range --}}
                @for($i = $start; $i <= $end; $i++)
                    @if($i == $current)
                        <span style="min-width:40px; padding:0.6rem 0.8rem; background:linear-gradient(135deg, #DAA520, #FFD700); color:#000; border-radius:8px; text-align:center; font-weight:700; box-shadow:0 4px 15px rgba(218, 165, 32, 0.3);" aria-current="page">{{ $i }}</span>
                    @else
                        <a href="{{ $members->url($i) }}" class="ajax-page" style="min-width:40px; padding:0.6rem 0.8rem; background:#222; color:#DAA520; border:2px solid #DAA520; border-radius:8px; text-align:center; font-weight:600; text-decoration:none; transition:all 0.3s ease; display:inline-block;"
                           onmouseover="this.style.background='#DAA520'; this.style.color='#000';"
                           onmouseout="this.style.background='#222'; this.style.color='#DAA520';">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Last page and ellipsis --}}
                @if($end < $last)
                    @if($end < $last - 1)
                        <span style="color:#999; font-weight:600;">…</span>
                    @endif
                    <a href="{{ $members->url($last) }}" class="ajax-page" style="min-width:40px; padding:0.6rem 0.8rem; background:#222; color:#DAA520; border:2px solid #DAA520; border-radius:8px; text-align:center; font-weight:600; text-decoration:none; transition:all 0.3s ease; display:inline-block;"
                       onmouseover="this.style.background='#DAA520'; this.style.color='#000';"
                       onmouseout="this.style.background='#222'; this.style.color='#DAA520';">{{ $last }}</a>
                @endif

                {{-- Next --}}
                @if($members->hasMorePages())
                    <a href="{{ $members->nextPageUrl() }}" class="ajax-page" style="padding:0.6rem 1.2rem; background:linear-gradient(135deg, #DAA520, #FFD700); color:#000; border-radius:8px; font-weight:600; font-size:0.95rem; text-decoration:none; transition:all 0.3s ease; display:inline-block;"
                       onmouseover="this.style.boxShadow='0 6px 20px rgba(218, 165, 32, 0.4)'; this.style.transform='translateY(-2px)';"
                       onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">Next &raquo;</a>
                @else
                    <span style="padding:0.6rem 1.2rem; background:#333; color:#666; border-radius:8px; cursor:default; font-weight:600; font-size:0.95rem; opacity:0.5;">Next &raquo;</span>
                @endif
            </div>
        </div>
    @endif
@else
    <div style="padding:2rem; text-align:center; color:#666;">Belum ada data anggota</div>
@endif
