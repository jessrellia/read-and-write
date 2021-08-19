<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ["stationary_type_id" => 1, "name" => "Archer & Olive A5 Light Blue Dot Grid Notebook", "stock" => 15, "price" => 205000, "description" => "A5 | 160 GSM | Dot grid | 160 Pages | Vegan with eco-friendly packaging", "image" => "asset/1.png"],
            ["stationary_type_id" => 1, "name" => "Archer & Olive A5 Forest Night Dot Grid Notebook", "stock" => 18, "price" => 205000, "description" => "A5 | 160 GSM | Dot grid | 160 Pages | Vegan with eco-friendly packaging", "image" => "asset/2.png"],
            ["stationary_type_id" => 1, "name" => "Archer & Olive A5 Moon Flowers Dot Grid Notebook", "stock" => 7, "price" => 240000, "description" => "A5 | 160 GSM | Dot grid | 160 Pages | Vegan with eco-friendly packaging", "image" => "asset/3.png"],
            ["stationary_type_id" => 1, "name" => "Archer & Olive A5 Pink Flowers Dot Grid Notebooks", "stock" => 10, "price" => 230000, "description" => "A5 | 160 GSM | Dot grid | 160 Pages | Vegan with eco-friendly packaging", "image" => "asset/4.png"],
            ["stationary_type_id" => 1, "name" => "Muji A5 Double Ring Notebook Dotted Beige", "stock" => 88, "price" => 85000, "description" => "A double ring notebook made with premium paper that feels good to write on.", "image" => "asset/5.png"],
            ["stationary_type_id" => 1, "name" => "Muji A6 Paper Slim Notebook", "stock" => 125, "price" => 40000, "description" => "A slim notebook, handy for carrying around or slipping inside a personal organiser. Made from high-quality paper that feels smooth to write on.", "image" => "asset/6.png"],
            ["stationary_type_id" => 1, "name" => "Muji B5 Memo Pad Plain", "stock" => 93, "price" => 35000, "description" => "Made from 50% recycled paper, lightweight notepaper, good for quick memos or drawings.", "image" => "asset/7.png"],
            ["stationary_type_id" => 1, "name" => "Muji A5 Planting Tree Paper Double Ring Notebook","stock" => 92, "price" => 37000, "description" => "A notebook made from planted wood pulp. The writing will not show through the page.", "image" => "asset/8.png"],
            ["stationary_type_id" => 1, "name" => "Muji B5 Recycling Paper Notebook","stock" => 95, "price" => 45000, 
            "description" => "Made using a thread-binding technique.", "image" => "asset/9.png"],

            ["stationary_type_id" => 2, "name" => "Stabilo Exam Grade Pencils (1pc)","stock" => 1306, "price" => 3500, 
            "description" => "Fit for Ujian Berbasis Komputer.", "image" => "asset/10.png"],
            ["stationary_type_id" => 3, "name" => "Muji 0.5 Black Gel Ink Set (6pcs)","stock" => 55, "price" => 99000, 
            "description" => "Ideal for school, office or university use and come in a set of 6. All of these pens are 0.5.", "image" => "asset/11.png"],
            ["stationary_type_id" => 3, "name" => "Muji Rubber Grip Polycarbonate Ballpoint Pen 0.7mm Black","stock" => 55, "price" => 99000, "description" => "Free flowing ballpoint pen with a comfortable grip for everyday writing.", "image" => "asset/12.png"],
            ["stationary_type_id" => 3, "name" => "Zebra Pen Sarasa Clip 1.0mm Black","stock" => 706, "price" => 21000, 
            "description" => "Retractable, water-based, pigment gel Ink. Smooth writing pen equiped with a binder clip", "image" => "asset/13.png"],
            ["stationary_type_id" => 3, "name" => "Pilot FriXion Erasable Pen","stock" => 11, "price" => 140000, 
            "description" => "This pen combines the ease of a retractable pen with Pilot's erasable thermo-sensitive gel ink.", "image" => "asset/14.png"],
            ["stationary_type_id" => 4, "name" => "Sharpie Permanent Marker Pastel Multicolor","stock" => 77, "price" => 220000, 
            "description" => "Proudly permanent ink marks on paper, plastic, metal, and most other surfaces.", "image" => "asset/15.png"],
            ["stationary_type_id" => 5, "name" => "Tombow Fudenosuke Brush Pen","stock" => 7, "price" => 49999, 
            "description" => "Fudenosuke Hard Tip Brush Pen features a firm yet flexible brush tip for different lettering and drawing techniques.", "image" => "asset/16.png"],
            ["stationary_type_id" => 4, "name" => "Tombow TwinTone Marker Set Pastel","stock" => 7, "price" => 244999, 
            "description" => "Double-sided marker creates thick or thin lines with two tip choices.", "image" => "asset/17.png"],
            ["stationary_type_id" => 5, "name" => "Tombow Dual Brush Pen","stock" => 7, "price" => 189999, 
            "description" => "Set of 6 Dual Brush Pen colors. Flexible brush tip and fine tip in one marker.", "image" => "asset/18.png"],

            ["stationary_type_id" => 6, "name" => "Ziegel Flat Ruler 16cm","stock" => 102, "price" => 29500, 
            "description" => "High quality  transparent ruler from Ziegel, a German company.", "image" => "asset/19.png"],
            ["stationary_type_id" => 6, "name" => "Muji Polycarbonate Double Ruler","stock" => 102, "price" => 50000, 
            "description" => "High quality polycarbonate double ruler fit for school and work.", "image" => "asset/20.png"],
            ["stationary_type_id" => 6, "name" => "Muji Easy-to-See Ruler","stock" => 71, "price" => 50000, 
            "description" => "This is a clear ruler with easily visible numbers that is easy to use even for the left-handed.", "image" => "asset/21.png"],
            ["stationary_type_id" => 6, "name" => "Butterfly 15cm Ruler","stock" => 682, "price" => 1350, 
            "description" => "15 cm clear ruler fit for school", "image" => "asset/22.png"],
            ["stationary_type_id" => 6, "name" => "Butterfly 30cm Ruler","stock" => 1199, "price" => 3000, 
            "description" => "30cm clear ruler fit for school.", "image" => "asset/23.png"],
            ["stationary_type_id" => 6, "name" => "Stainless 15cm Ruler","stock" => 397, "price" => 1700, 
            "description" => "Accurate ruler made of stainless steel.", "image" => "asset/24.png"],
            ["stationary_type_id" => 6, "name" => "Wooden 15cm Ruler","stock" => 25, "price" => 14500, 
            "description" => " Vivid cartoon design, made of wood, very light and easy to carry. Smooth surface, clear scale can be read easily.", "image" => "asset/25.png"],
            ["stationary_type_id" => 6, "name" => "Maped Essentials 12cm Protactor and Ruler","stock" => 42, "price" => 23000, 
            "description" => "12cm Ruler and 180 degrees protactor.", "image" => "asset/26.png"],
            ["stationary_type_id" => 6, "name" => "Faber-Castell Mathematical Ruler Set","stock" => 59, "price" => 20000, 
            "description" => "Consists of 180 Degree Protractor, 60, 90, 30 Set Square, 45, 90 Degree Set Square and 1 15cm Ruler.", "image" => "asset/27.png"],

            ["stationary_type_id" => 7, "name" => "Oxford Dictionary of English","stock" => 70, "price" => 235000, 
            "description" => "The Oxford Dictionary of English offers authoritative and in-depth coverage of over 350,000 words, phrases, and meanings.", "image" => "asset/28.png"],
            ["stationary_type_id" => 7, "name" => "Oxford Advanced Learner's Dictionary","stock" => 100, "price" => 188000, 
            "description" => "The world's best-selling advanced learner's dictionary, is now in its 7th Edition.", "image" => "asset/29.png"],
            ["stationary_type_id" => 7, "name" => "Gramedia Kamus Inggris Indonesia","stock" => 46, "price" => 178000, 
            "description" => "Indonesian-English dictionary", "image" => "asset/30.png"],
            ["stationary_type_id" => 7, "name" => "Oxford Advanced Learner's English-Korean Dictionary","stock" => 11, "price" => 457000, 
            "description" => "Indonesian-English dictionary", "image" => "asset/31.png"],
            ["stationary_type_id" => 7, "name" => "Korean Standard Dictionary","stock" => 10, "price" => 159000, 
            "description" => "This reference is perfect for businesspeople, students, and travelers and contains over 20,000 entries of essential Korean.", "image" => "asset/32.png"],
            ["stationary_type_id" => 7, "name" => "Langenscheidt Standard Dictionary","stock" => 12, "price" => 250000, 
            "description" => "The Langenscheidt Standard Dictionary German is a comprehensive reference work.", "image" => "asset/33.png"],
            ["stationary_type_id" => 7, "name" => "Langenscheidt German Dictionary","stock" => 41, "price" => 235000, 
            "description" => "A book that belongs on every German learner’s desk.", "image" => "asset/34.png"],
            ["stationary_type_id" => 7, "name" => "Kamus Jerman-Indonesia","stock" => 38, "price" => 130000, 
            "description" => "Complete guide to help learners study the German language.", "image" => "asset/35.png"],
            ["stationary_type_id" => 7, "name" => "Kamus Indonesia - Daerah","stock" => 32, "price" => 166000, 
            "description" => "Translates Indonesian words to Javanese, Balinese, Sundanese, and Madura languages.", "image" => "asset/36.png"]
        ]);
    }
}
