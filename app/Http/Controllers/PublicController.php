<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organization;
use App\Models\Achievement;
use App\Models\Coach;
use App\Models\Member;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Ambil 3 event terbaru
        $events = Event::orderBy('date', 'desc')->take(3)->get();

        $years = date('Y') - config('site.founded_year', 1984);

        $stats = [
            'members' => Member::count(),
            'coaches' => Coach::count(),
            'achievements' => Achievement::count(),
            'years' => $years
        ];

        return view('public.home', compact('events', 'stats'));
    }

    public function events()
    {
        // Ambil semua events dari database
        $events = Event::orderBy('date', 'desc')->get();
        return view('public.events', compact('events'));
    }

    public function about()
    {
        $about = [
            'history' => 'Ambalan MOHAMMAD HATTA-RAHMI HATTA dibentuk pada tanggal 10 November 1984. Akan tetapi ini pun belum di sah kan dan baru di sah kan pada tanggal 13 Februari 1985. Pada tanggal 10 November 1986 adalah keputusan Hari Ulang Tahun Ambalan.

Ambalan Kami Dinamakan Moh Hatta-Rahmi Hatta karena waktu dulu sekolah SMKN 1 Garut adalah Sekolah Menengah Ekonomi Atas yang berbasis ekonomi, keuangan, dan manajmen bisnis. Oleh karena itu nama Moh Hatta dan Rahmi Hatta diambil dari Bapak koperasi Indonesia yaitu Drs. Moh Hatta untuk nama ambalan Putra dan untuk nama ambalan putri diambil dari nama istrinya yaitu Rahmi Hatta. Maksudnya keberhasilan suami dalam hal apapun tidak lepas dari bantuan dan doa seorang istri. Kerjasama yang sangat harmonis dan romantis, makannya dinamaan Moh Hatta-Rahmi Hatta supaya terjalin kerjasama yang harmonis demi tujuan yang satu yaitu menghasilkan generasi yang siap berkarya dan berbakti dimanapun berada.
',
            'vision' => '“Mewujudkan Anggota Pramuka Yang Unggul, Berprestasi Dan Berbudi Pekerti Luhur Serta Menjadikan Pramuka SMKN 1 Garut Sebagai Wadah  Untuk Mengembangkan Minat Dan Bakat Para Anggota Sehingga Terciptanya Anggota Pramuka Yang Patriotisme, Bertanggung Jawab , Mempunyai Jiwa Kepemimpinan Dan Peduli Pada Diri Sendiri Serta Lingkungan”.
',
            'mission' => [
                'Menanamkan nilai Tri satya dan Dasa Dharma',
                'Meningkatkan kualitas kepramukaan melalui kegiatan yang mendidik dan menginspirasi',
                'Mendorong pencapaian prestasi dengan mengikuti event, lomba dan kegiatan yang menumbuhkan semangat berprestasi',
                'Mengembangkan minat dan bakat anggota secara optimal',
                'Membangun jiwa kepemimpinan dan rasa tanggung jawab di setiap anggota',
                'Mendorong anggota untuk peduli terhadap lingkungan',
                'Menumbuhkan semangat patriotisme dan cinta tanah air',
                'Membangun komunikasi dan kerjasama yang baik antaranggota'
            ]
        ];

        // Ambil dari database
        $achievements = Achievement::orderBy('year', 'desc')->get();
        $coaches = Coach::all();
        return view('public.about', compact('about', 'achievements', 'coaches'));
    }

    public function membership(Request $request)
    {
        $years = date('Y') - config('site.founded_year', 1984);

        $stats = [
            'members' => Member::count(),
            'coaches' => Coach::count(),
            'achievements' => Achievement::count(),
            'years' => $years
        ];

        // Ambil struktur organisasi dari database
        $organizations = Organization::orderBy('level')->orderBy('id')->get();
        
        // Kelompokkan berdasarkan level dan pastikan setiap entry adalah array dengan default
        $ketuaModel = $organizations->where('level', 1)->first();
        $wakilModel = $organizations->where('level', 2)->first();
        $sekretarisModel = $organizations->where('level', 3)->where('position', 'Sekretaris')->first();
        $bendaharaModel = $organizations->where('level', 3)->where('position', 'Bendahara')->first();
        $seksiModels = $organizations->where('level', 4)->values();

        $organization = [
            'ketua' => $ketuaModel ? [
                'name' => $ketuaModel->name ?? '-',
                'class' => $ketuaModel->class ?? '-',
                'position' => $ketuaModel->position ?? null,
            ] : [
                'name' => '-', 'class' => '-', 'position' => null
            ],
            'wakil' => $wakilModel ? [
                'name' => $wakilModel->name ?? '-',
                'class' => $wakilModel->class ?? '-',
                'position' => $wakilModel->position ?? null,
            ] : [
                'name' => '-', 'class' => '-', 'position' => null
            ],
            'sekretaris' => $sekretarisModel ? [
                'name' => $sekretarisModel->name ?? '-',
                'class' => $sekretarisModel->class ?? '-',
                'position' => $sekretarisModel->position ?? 'Sekretaris',
            ] : [
                'name' => '-', 'class' => '-', 'position' => 'Sekretaris'
            ],
            'bendahara' => $bendaharaModel ? [
                'name' => $bendaharaModel->name ?? '-',
                'class' => $bendaharaModel->class ?? '-',
                'position' => $bendaharaModel->position ?? 'Bendahara',
            ] : [
                'name' => '-', 'class' => '-', 'position' => 'Bendahara'
            ],
            'seksi' => $seksiModels->map(function ($m) {
                return [
                    'name' => $m->name ?? '-',
                    'position' => $m->position ?? '-',
                    'class' => $m->class ?? '-',
                ];
            })->toArray(),
        ];

        $benefits = [
            'Pelatihan keterampilan kepemimpinan dan survival',
            'Sertifikat resmi dari Kwartir Daerah',
            'Kesempatan mengikuti kompetisi tingkat nasional',
            'Jaringan alumni yang luas',
            'Pengembangan soft skills dan hard skills',
            'Pengalaman berkemah dan petualangan',
            'Kegiatan sosial dan pengabdian masyarakat',
            'Beasiswa prestasi untuk anggota berprestasi'
        ];

        $requirements = [
            'Siswa/siswi aktif SMKN 1 Garut',
            'Fotokopi KTP/Kartu Pelajar',
            'Pas foto 3x4 (2 lembar)',
            'Surat pernyataan orang tua',
            'Biaya pendaftaran Rp 50.000',
            'Seragam pramuka lengkap',
            'Komitmen mengikuti kegiatan rutin',
            'Berbadan sehat'
        ];

        $levels = [
            (object)[
                'name' => 'Siaga',
                'age' => '7-10 tahun',
                'description' => 'Tingkat dasar untuk memperkenalkan pramuka',
                'members' => 0
            ],
            (object)[
                'name' => 'Penggalang',
                'age' => '11-15 tahun',
                'description' => 'Pengembangan keterampilan dasar kepramukaan',
                'members' => 65
            ],
            (object)[
                'name' => 'Penegak',
                'age' => '16-20 tahun',
                'description' => 'Pendalaman leadership dan keterampilan lanjutan',
                'members' => 85
            ],
            (object)[
                'name' => 'Pandega',
                'age' => '21-25 tahun',
                'description' => 'Tingkat tertinggi dengan tanggung jawab penuh',
                'members' => 0
            ]
        ];

        // Ambil data anggota dari database (urut berdasarkan nama lengkap), paginated
        $members = Member::orderBy('full_name')->paginate(12)->withQueryString();

        // If this is an AJAX request, return only the members partial (HTML fragment)
        if ($request->ajax()) {
            return view('public.partials.members_list', compact('members'));
        }

        // render the members view (keanggotaan)
        return view('public.members', compact('stats', 'organization', 'benefits', 'requirements', 'levels', 'members'));
    }

    public function members(Request $request)
    {
        // reuse membership data and view, forward request for AJAX detection
        return $this->membership($request);
    }
}