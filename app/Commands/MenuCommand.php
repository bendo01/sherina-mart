<?php
declare(strict_types=1);
namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Models\Category;

class MenuCommand extends Command
{
    public Category $category;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:menu-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'menampilkan Menu pada pengguna';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = "Selamat di Applikasi Kami\nSilahkan Pilih Menu Berikut :";
        $options = [
            "Pilihan 1: Transaksi Pembelian Barang",
            "Pilihan 2: Daftar Kategori Barang",
            "Pilihan 3: Tambah Kategori Barang",
            "Pilihan 4: Ubah Kategori Barang",
            "Pilihan 5: Hapus Kategori Barang",
            "Pilihan 6: Daftar Jenis Barang",
            "Pilihan 7: Tambah Jenis Barang",
            "Pilihan 8: Ubah Jenis Barang",
            "Pilihan 9: Hapus Jenis Barang",
            "Pilihan 10: Daftar Barang",
            "Pilihan 11: Tambah Barang",
            "Pilihan 12: Ubah Barang",
            "Pilihan 13 : Hapus Barang",
        ];

        $option = $this->menu($title, $options)
            ->setForegroundColour("green")
            ->setBackgroundColour("black")
            ->setWidth(200)
            ->setPadding(10)
            ->setMargin(5)
            ->setExitButtonText("Abort")
            // remove exit button with
            // ->disableDefaultItems()
            ->setTitleSeparator("*-")
            // ->addLineBreak('<3', 2)
            // ->addStaticItem('AREA 2')
            ->open();

        // $this->info("Anda Memilih Pilihan : {$option}");
        if ($option == 0) {
            $this->info("Anda Memilih Pilihan : {$option} Transaksi Pembelian Barang");
        } else if ($option == 1) {
            $this->info("Anda Memilih Pilihan : {$option} Daftar Kategori Barang");
            foreach (Category::all() as $category) {
                $this->line("Kode : {$category->code} | Nama : {$category->name}");
            }
        } else if ($option == 2) {
            $this->info("Anda Memilih Pilihan : {$option} Tambah Kategori Barang");
            $category = new Category();
            $category->code = (int)$this->ask("Masukkan Kode Kategori : ");
            $category->name = $this->ask("Masukkan Nama Kategori : ");
            if ($category->save()) {
                $this->notify("Success", "data berhasil disimpan");
            } else {
                $this->notify("Failed", "data gagal disimpan");
            }

        } else if ($option == 3) {
            $this->info("Anda Memilih Pilihan : {$option} Ubah Kategori Barang");
            $code = (int)$this->ask("Masukkan Kode Kategori yang akan diubah : ");
            $category = Category::where('code', $code)->first();
            $category->code = (int)$this->ask("Masukkan Kode Kategori : ");
            $category->name = $this->ask("Masukkan Nama Kategori : ");
            if ($category->save()) {
                $this->notify("Success", "data berhasil diubah");
            } else {
                $this->notify("Failed", "data gagal diubah");
            }
        } else if ($option == 4) {
            $this->info("Anda Memilih Pilihan : {$option} Hapus Kategori Barang");
            $code = (int)$this->ask("Masukkan Kode Kategori yang akan dihapus : ");
            $category = Category::where('code', $code)->first();
            if ($category->delete()) {
                $this->notify("Success", "data berhasil dihapus");
            } else {
                $this->notify("Failed", "data gagal dihapus");
            }
        } else if ($option == 5) {
            $this->info("Anda Memilih Pilihan : {$option} Daftar Jenis Barang");
        } else if ($option == 6) {
            $this->info("Anda Memilih Pilihan : {$option} Tambah Jenis Barang");
        } else if ($option == 7) {
            $this->info("Anda Memilih Pilihan : {$option} Ubah Jenis Barang");
        } else if ($option == 8) {
            $this->info("Anda Memilih Pilihan : {$option} Hapus Jenis Barang");
        } else if ($option == 9) {
            $this->info("Anda Memilih Pilihan : {$option} Daftar Barang");
        } else if ($option == 10) {
            $this->info("Anda Memilih Pilihan : {$option} Tambah Barang");
        } else if ($option == 11) {
            $this->info("Anda Memilih Pilihan : {$option} Ubah Barang");
        } else if ($option == 12) {
            $this->info("Anda Memilih Pilihan : {$option} Hapus Barang");
        } else {
            
            $this->info("Terimakasih telah menggunakan applikasi kami.");
        }

    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
