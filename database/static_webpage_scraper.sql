-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2020 at 12:32 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `static_webpage_scraper`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pictures` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cardInfo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profileViews` int(11) NOT NULL DEFAULT 0,
  `appearedIn` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'system',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updateCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `newspaper_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'title',
  `excerpt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'excerpt',
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'thumbnail',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publisher',
  `published_on` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published_on',
  `views` int(11) NOT NULL DEFAULT 0,
  `polarity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'system',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updateCount` int(11) NOT NULL DEFAULT 0,
  `ratedFor` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `newspaper_id`, `title`, `excerpt`, `body`, `thumbnail`, `link`, `publisher`, `published_on`, `views`, `polarity`, `is_active`, `added_by`, `created_at`, `updated_at`, `updateCount`, `ratedFor`) VALUES
(109, 1, 'The Pakistani children’s author focusing on the planet', 'Writer and illustrator Rumana Husain has been educating children about the pressures the planet is under since the 1980s.', '<p>Helping children understand the mammoth pressures the planet is under can be a daunting task. But Karachi-based writer and illustrator Rumana Husain has been connecting the dots between air pollution, plastic, development and their toll on the living world for over three decades through her exquisite picture books.</p><p>“I have always preferred to write and speak about nature… its bounties, trees, animals, the earth and environment, man’s ruthless exploitation of it… as well as friendship, empathy, peace, harmony, inclusivity,” said the writer of more than 60 books.</p><p>Recently, Husain has been on a new mission: to encourage children to love books and reading. She also wants to revive the culture of adults sitting down with children because, she said, children’s books are meant to be read aloud.</p><p>The Covid-19 pandemic forced everyone to slow down and families to spend more time together. It was an ideal moment for Husain’s mission — particularly to encourage parents and children to take a moment, step back and think about the destruction being wrought on the planet.</p><p>She is doing this through storytelling. Since March, she has uploaded over 170 videos, she told The Third Pole from the United States, where she has been for five months, spending the “pandemic time” with family. As well as telling stories from her own books, Husain chooses titles from her granddaughters’ bookshelves. She posts videos on her Facebook page, Instagram and YouTube.</p><p>She uses a mixture of old and contemporary literature and a dash of poetry. From Arabian Nights to Shel Silverstein’s famous book *The Giving Tree* and her own work, she said she strives to stay close to the themes she feels strongly about. In some videos, she translates English storybooks into Urdu “so that they are better understood by children in Pakistan”, she said.</p><p>She has started to receive messages from a budding fan club. One said, “I spent all night watching you reading your stories…”; another enthused, “Your storytelling is amazing!” And some of Pakistan’s intellectuals, including the educationist and linguist Arfa Zehra, have sent her long video messages — which she said make her feel truly honoured. In addition, some schools are using her videos for their online classes.</p><p>One theme keeps cropping up across Husain’s work: the environment. Her first books Hasan ki Gali (Hasan’s Lane), on rubbish and keeping neighbourhoods clean, and Kala Bhoot, which gave life and personality to the ubiquitous plastic bag, were published over two decades ago — but their messages are as important as ever.</p><p>She explained the concept of sustainable development in a graphic book, Dr Akhtar Hameed Khan, about the Pakistani development practitioner and social scientist. A bilingual book Khoo-Khoo-Khoo — The Coughing City dealt with overpopulation, air and sound pollution, and infrastructure development that leaves little room for animals and trees.</p><p></p><p>Her work is celebrated both in Pakistan and abroad. In 2014, she won the fourth UBL-Jang Literary Excellence Award (2014) for Dr Akhtar Hameed Khan. Her award-winning book Laal Badaam (The Moringa Tree) has been translated into five other languages. Another bilingual book, Prerana and Laal Peela, which she co-authored with Nepali writer Buddhi Sagar, won the Nepalese Society for Children’s Literature’s best book award.</p><p>Another feather in her cap is developing the curriculum on the environment back in the 1980s for C.A.S, a private school in Karachi, where she was head teacher. She single-handedly developed the entire curriculum for classes three to six, complete with work sheets and teaching manuals.</p><p>In addition to her online storytelling, Husain recently published her first e-book for Amazon: Etienne and the Angry Dot — a story about a young child living through lockdown told in rhyme that was “bubbling inside” her. Early on, it became a family project. “My son, in particular, gave some useful input, and also encouraged me to publish it on Amazon and my daughter Asma designed the layouts,” she said.</p><p></p><p>She was inspired to write the book by Etienne, her three-year-old grandson who lives in Paris.</p><p>“I wanted to explain to Etienne that the virus is nasty and it has been doing phenomenal harm globally, therefore we need to be taking utmost precautions against it,” she said. “It shall pass, but we need to learn some lessons from these times.”</p><p>She did not want to write it in prose, as she felt it would become “dark and intense”. By opting for rhyme she hoped to lessen children’s anxiety while adding “caution as well as a lot of hope”. She also wanted to explain to children that the reduction in human activity during lockdowns had had a temporary “healing” effect on the damage caused by mankind on the planet. Husain stressed that she does not want to “overtly thrust morals down children’s throats”, but create books that are “interesting, fun to read, unbiased and have subtle messages”.</p><p>Baela Raza Jamil, founder of the Children’s Literature Festival in Lahore, told The Third Pole, “Her books are definitely nothing like the textbooks that our children are forced to read and study in schools. Reading for pleasure and lively learning is what we strive to promote, and that’s what Rumana is good at through her writings and her illustrations.”</p><p>This article was first carried on The Third Pole and has been reproduced with permission.</p>', '/images/newspapers/thumbnails/5f574b09eed02.jpg', 'https://www.dawn.com/news/1578574/the-pakistani-childrens-author-focusing-on-the-planet', 'Zofeen T. Ebrahim', 'Published 08 Sep, 2020 02:24pm', 0, '0', 1, 'system', '2020-09-08 16:51:29', '2020-09-08 16:51:29', 0, 0),
(110, 1, 'Death toll from rockslide at marble quarry in KP\'s Mohmand rises to 19', 'An operation to rescue those trapped underneath the rubble is currently underway.', '<p>The death toll from a rockslide in Khyber Pakhtunkhwa\'s Mohmand district rose to 19 on Tuesday after six more bodies were pulled from the rubble by rescue officials and two of the injured died.</p><p>In a statement earlier today, the Provincial Disaster Management Authority (PDMA) director general said nine injured had been rescued so far.</p><p>A spokesperson for Rescue 1122 Bilal Faizi later said that most of those injured were in a serious condition, adding that two of them died while receiving treatment at Mohmand Hospital. At least five people are still buried beneath the rubble, Faizi said.</p><p>\"An operation to rescue those trapped underneath the rubble is currently underway. Five ambulances and one recovery vehicle have been sent to Mohmand from Peshawar,\" according to the PDMA director general.</p><p>He added that the authority was closely coordinating with the district administration and the relevant departments.</p><p>Between 40 and 50 people were at the site at the time of the collapse which occurred on Monday evening, Tariq Habib, district police chief of Mohmand district told Reuters.</p><p>“Usually a large number of people work in these marble mines but luckily a majority had finished work and returned home,” he said.</p><p>Meanwhile, PPP Chairman Bilawal Bhutto-Zardari expressed grief over the lives lost in the incident. He also called upon the provincial government to fulfill its duty by rescuing those trapped underneath the rubble and by providing the injured with medical aid.</p><p></p><p>\"Immediate and effective steps are needed to prevent such incidents from occurring in the future,\" he said. Bilawal also called upon party workers to assist in the rescue operation.</p><p>Minister for Science and Technology Fawad Chaudhry added that working conditions for labourers were extremely bad.</p><p>\"Provincial governments should ensure the strict implementation of labour laws,\" he said in a tweet, adding that he hoped the KP government would stand with the families of those killed in the incident.</p><p></p><p>On Monday, huge parts of the famous Ziarat marble mountain in Safi tehsil of Mohmand tribal district fell onto several nearby mines.</p><p>Eleven bodies and five injured were pulled out from under the rubble and shifted to Ghalanai Hospital, Rescue 1122 had said in a statement, adding that more people were feared trapped under the debris.</p><p>A district administration official had quoted locals as saying that at least 25 people were missing after the rockslide. The remote area does not have mobile and internet coverage, the official had added.</p><p>Rescue 1122 had said its Mohmand team was carrying out a search operation to find the missing people, adding that additional personnel had been dispatched to the area from Peshawar and Charsadda</p><p>Besides search and rescue tools, heavy machinery and ambulances were taking part in the operation, the rescue service had added.</p>', '/images/newspapers/thumbnails/5f572f83676a8.png', 'https://www.dawn.com/news/1578566/death-toll-from-rockslide-at-marble-quarry-in-kps-mohmand-rises-to-19', 'Sirajuddin', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:51:37', '2020-09-08 16:51:37', 0, 0),
(111, 1, 'Rizwan Beyg finally awarded his Tamgha-e-Imtiaz', '\"The CSR our label has shown, the work we\'ve done in the past decade with women in rural villages, is the reason for this award.\"', '<p>With an atelier label established in 1989, namesake Rizwan Beyg just received the highest civilian honour Tamgha-e-Imtiaz for his wholesome contribution to the country and its fashion industry.</p><p>Taking to social media, he shared the amazing news with his fans and followers on Instagram.</p><p>A photo posted by Instagram (@instagram) on Mar 22, 2015 at 11:21am PDT</p><p></p><p>\"A year later than scheduled but finally got the Tamgha-e-Imtiaz at a small intimate ceremony at the Governor House Sindh,\" the designer posted.</p><p>Also read: Veteran fashion designer, Rizwan Beyg receives Tamgha-e-Imtiaz</p><p>Expressing his gratitude, he further thanked all the people who stood by him on this journey.</p><p>\"May we continue to be proud Pakistanis, thank you Pakistan for the respect and honour.\"</p><p>Beyg also took to reiterate the reason behind his victory.</p><p>A photo posted by Instagram (@instagram) on Mar 22, 2015 at 11:21am PDT</p><p></p><p>\"Many believe I have gotten this honour because of my designing profession. But the reality is the corporate social responsibility our label has shown, the work we have done over the course of the past 10 years with women in rural villages, that is the reason for this award.\"</p><p>\"We\'re working hard and hoping to grow our capacity building with such women and get more women from more villages on board - providing them with jobs and opportunities to increase their income for a better life ahead,\" he posted.</p><p>Congratulations sir, may you continue making the country proud!</p>', '/images/newspapers/thumbnails/5f572e72c676a.jpg', 'https://www.dawn.com/news/1578567/rizwan-beyg-finally-awarded-his-tamgha-e-imtiaz', 'Images Staff', 'Updated 08 Sep, 2020 12:57pm', 0, '0', 1, 'system', '2020-09-08 16:51:43', '2020-09-08 16:51:43', 0, 0),
(112, 1, 'China, India accuse each other of firing shots in border dispute', 'Chinese border guards took “countermeasures” to stabilise the situation, says China army spokesman.', '<p>China accused Indian troops of violating a bilateral agreement and firing warning shots in the air during a confrontation with Chinese personnel on the disputed border on Monday, amid renewed tensions between the two countries.</p><p>Chinese border guards took “countermeasures” to stabilise the situation, Zhang Shuili, spokesman for the military’s western command theatre, said in a statement published by the military’s official news website early on Tuesday.</p><p>The statement did not make clear what those measures were or whether Chinese troops also fired warning shots.</p><p>India, on the other hand, rejected Chinese allegations of violating border agreements and accused Chinese troops of firing in the air during a face-off on their tense de facto border.</p><p>“It is the PLA that has been blatantly violating agreements and carrying out aggressive manoeuvres, while engagement at military, diplomatic and political level is in progress,” the Indian army said in a statement.</p><p>It said Chinese soldiers tried to close in on a forward Indian position in the Ladakh sector in the western Himalayas and when they were met by Indian troops, the PLA fired a few rounds in the air.</p><p>Both sides have observed a long-held protocol to avoid using firearms on the sensitive, high altitude frontier running through the western Himalayas, though this agreement has not prevented casualties.</p><p>Twenty Indian soldiers were killed in hand-to-hand fighting in a clash in June, an incident that led to China and India deploying additional forces along the frontier.</p><p>“We request the Indian side to immediately stop dangerous actions...and strictly investigate and punish personnel who fired shots to ensure that similar incidents do not occur again,” Zhang said in the statement.</p><p>The disputed and undemarcated 3,500-kilometer (2,175-mile) border between India and China, referred to as the Line of Actual Control, stretches from the Ladakh region in the north to the Indian state of Arunachal Pradesh.</p><p>China says the frontier is about 2,000 kilometers (1240-mile) and claims entire Arunachal Pradesh as its territory.</p>', '/images/newspapers/thumbnails/5f572e3c4efa9.jpg', 'https://www.dawn.com/news/1578561/china-india-accuse-each-other-of-firing-shots-in-border-dispute', 'Reuters', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:51:48', '2020-09-08 16:51:48', 0, 0),
(113, 1, 'Adnan Siddiqui plays the flute to honour Pakistan Air Force', '\"As a tribute to these magnanimous superheroes on Youm-e-Fizaya, a very small gesture from me.\"', '<p>As a way to pay homage to the martyrs of Pakistan Air Force (PAF) for sacrificing their lives in defence of the country during the Indo-Pak War in 1965, on 7 September every year, a contingent of PAF present guard of honour at the tomb of late fighter pilot Rashid Minhas— while the rest of us, celebrate Youm-e-Fizaya in our own special way.</p><p>Actor Adnan Siddiqui took to Instagram yesterday to commemorate \"the real heroes of our skies,\" and posted a video of himself playing the flute to the tune of Noor Jahan\'s famous song \'Ae Watan Ke Sajeele Jawaano\'.</p><p>In the post, Siddiqui says, \"Our men in blues—fearless, gallant, invincible—are the real heroes of our skies. Their indomitable spirit, unyielding devotion towards Pakistan and gritty resolve to guard this beautiful country, inspires patriotic fervour in us every day. They tell us that there is no glory, no pride greater than the nation.\"</p><p>A photo posted by Instagram (@instagram) on Mar 22, 2015 at 11:21am PDT</p><p></p><p>He continues, \"As a tribute to these magnanimous superheroes on Youm-e-Fizaya, a very small gesture from me—flute rendition of the very moving Ae Watan Ke Sajeele Jawaano by Mallika-e-Tarannum Noorjehan. I get goosebumps every time I listen to this song, and playing it was equally overwhelming.\"</p><p>He dedicated the song to the the \'lionhearts\' (Sherdils), thanking them for their service to the country.</p><p>Written by late Jamiluddin and famously sung by Noor Jehan, the song Ae Watan Ke Sajeele Jawaano is an old classic political song that was used as a morale booster for the young soldiers in the 1965 War.</p>', '/images/newspapers/thumbnails/5f5626301bb96.jpg', 'https://www.dawn.com/news/1578559/adnan-siddiqui-plays-the-flute-to-honour-pakistan-air-force', 'Images Staff', 'Updated 08 Sep, 2020 11:14am', 0, '0', 1, 'system', '2020-09-08 16:51:53', '2020-09-08 16:51:53', 0, 0),
(114, 1, 'Accountability rush', 'No one seems interested in demanding stronger, more independent institutions.', '<p>ASSETS have become a four-letter word in Pakistani politics. Let talk begin of the ‘assets’ of anyone well known, especially in politics, and chances are it will not end well — or ever end.</p><p>From a prime minister (Nawaz Sharif) to a judge (Qazi Faez Isa) to a former military man (Asim Saleem Bajwa), they have all been accused of hiding their wealth and because it was not made public it is assumed that it was illegally gotten.</p><p>But what is even more fascinating is the reaction to these allegations made public. Our ability to buy them or reject them is directly linked to our political affiliation and not to the ‘facts’ made public. And because it’s a matter of belief, the ‘faith’ is rarely shaken, regardless of what follows. Be it the case of the former prime minister or the current judge, or present cabinet members, political beliefs decide which side of the issue we will land on and stay, no matter what transpires later.</p><p>Is this because of the polarisation in our politics? Partly, this is so for our national political scene is rather Manichean these days and everything is either to be accepted for all its goodness or rejected entirely for being evil. Shades of grey are old-fashioned, even if the book so titled proved rather popular. In our part of the world, for those who follow politics closely, it’s black and it’s white, as Michael Jackson once crooned.</p><p>No one seems interested in demanding stronger, more independent institutions.</p><p>And, therefore, wealth is accepted or its accumulation deemed acceptable, or otherwise because of who the owner is. And not the size or origins of the wealth. Facts have never been less important.</p><p>But this, too, is only part of the story.</p><p>Another part of it is linked to the undocumented nature of the economy. Chances are that most of those who are well known and wealthy have riches they can’t explain because of the manner in which businesses and people in Pakistan operate; figures are fudged and income tax evaded. And this is helped along by the law which says any ‘remittance’ from abroad will not be questioned. It is one of our, many, open secrets that unaccounted money is sent abroad through illegal means and then sent back through banking channels. And once this is done, the money is legit, till a fuss is kicked up for reasons other than the law and taxes. Such transactions would be found in many a bank account of the rich and the famous.</p><p>And the second issue here is of the breakdown of our institutions. Be it the FBR or investigative agencies such as the FIA which should be looking into these matters and determining the facts, none of them is capable of doing this. The organisations are so compromised that their inquiries and decisions lead to no closure.</p><p>As a result, scandals or allegations turn into a never-ending soap. Take the case of Nawaz Sharif — from Hudaibiya to Panama to the JIT to the NAB courts, it’s a story spanning decades and yet nothing is settled or resolved. Neither the details and reality of the ‘wrongs’ nor if they were really committed — those who believe in his innocence or his guilt do so by ignoring the actions and the findings of the state institutions, which in turn will declare him innocent or guilty, depending on the times and the political environment.</p><p>Hence, a case will be closed by the courts and in retrospect the decision will seem shady. Investigations will go on for years without anyone ever hearing anything and then suddenly they will move at breakneck speed and evidence will pile up faster than it is consumed. It is all, always, part of a game and rarely ever due to an institution doing its job.</p><p>This perhaps is the most worrying aspect. For without stronger institutions, none of these problems will ever addressed. After all, Pakistan is not the only country where the powerful are able to influence the system; it happens elsewhere also. But at some stage, the allegations or the scandal is big enough for the institutions to ignore all pressure and just do their job. The Epstein or Weinstein convictions are a case in point. And this is essential if people are to still have some level of trust in the state.</p><p>But this is never our goal. Because for everyone involved, it’s easier to keep NAB or FIA or even the trial courts so compromised that either accountability can be avoided or used for political ends. And this is true of the politicians as well as the establishment. And unfortunately, if there is any unspoken consensus between the two at the moment, it is to not address the larger systemic problems; instead, it’s to continue manipulating the system for political ends.</p><p>And sadly, the rest of us have become part of the game. We, too, now want a general or a politician or a judge to be held accountable. For some the politician is more accountable because he is elected to office by the people; for others, a general should be because politicians have already offered themselves up for accountability and paid a ‘heavy price’ more than once; and others still, a judge providing answers will ensure the fairness of the system. But no one seems interested in demanding stronger, more independent institutions which would do due diligence away from the public glare and also ensure that a scandal or an allegation is put to bed, one way or the other. However, in our part of the world, this is such a boring approach. And it doesn’t allow us to beat our chest and announce our patriotic or liberal credentials. Grey, after all, is a four-letter word.</p><p>The writer is a journalist.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56e927b9390.jpg', 'https://www.dawn.com/news/1578556/without-stronger-institutions-the-problem-of-accountability-will-never-be-addressed', 'Arifa Noor', '08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:51:56', '2020-09-08 16:51:56', 0, 0),
(115, 1, 'To draw the battle lines now', 'Are the opposition in India for a war with China or are they gloating over a stick they may have found to beat a Teflon rival?', '<p>AN unspoken dispute stalks India’s Congress party. It may define the battle lines for the scattered opposition groups to align against a ferocious but not invincible right-wing assault on democracy. The little discussed problem concerns rival views offered by former prime minister Manmohan Singh and former Congress president Rahul Gandhi about what critically threatens India’s liberal democracy.</p><p>Singh, during his 10-year rule, had described left-wing extremism as the single largest internal security threat for India. That Prime Minister Modi has embraced the view can be seen from the way leftist intellectuals are being declared Maoists before being sent to rot in prison. Gandhi on the other hand had told a US ambassador years ago, in comments subsequently published by WikiLeaks, that right-wing Hindu extremists posed a truly existential threat to Indian democracy. For this and more, Gandhi has been trolled and abused by the ruling establishment, and less openly by lobbies in his own party.</p><p>There are two other notable differences between Gandhi and Singh. The younger politician says he doesn’t care if his political career gets destroyed in the quest to save Indian democracy, a sentiment one doesn’t associate with Singh’s ascent to power. It’s a lofty, romantic thought borrowed from popular 16th-century poet-philosopher Kabir.</p><p>The verse was adapted in Urdu by Majrooh Sultanpuri and loaned to Pakistan in its struggle for democracy during the Ayub dictatorship. “Jala ke mishal-i-ja’n hum junu’n-sifaat chaley/ Jo ghar ko aag lagaae hamaray saath chaley”. (“We’ve turned our bodies into flames to ford the dark night/ Those eager to self-destruct could win the fight.”) One remembers here that the Congress had given a call during Prime Minister Modi’s first innings to launch a second freedom movement. Where has that call stalled?</p><p>Are the opposition in India for a war with China or are they gloating over a stick they may have found to beat a Teflon rival with?</p><p>Something else Gandhi said has earned him sneers from the right-wing within and outside his party. Had a Gandhi member been in the saddle in 1992 the Babri Masjid would not be harmed. That’s what Rahul once said without trying to rub in the point that Singh was a lionised member of the Narasimha Rao cabinet that slept through the mosque’s destruction. Rajiv Gandhi had been assassinated the previous year.</p><p>Between Singh’s and Gandhi’s contentions lies the essential crisis for India at the current dire crossroads. A recent letter from a group of Congress politicians obliquely critical of the Gandhis probably had the support of tycoons who have sworn never to see a Gandhi in the saddle. Their anti-Gandhi sentiment had hardened after Rajiv Gandhi threatened in Mumbai during the 1985 celebrations of the Congress centenary that he would punish the “moneybags riding the backs of the Congress party worker”. His opponents, including those from within his charmed circle of friends, joined hands to tar him instead with the Bofors scandal.</p><p>WikiLeaks signalled a third element that’s driving cynical politics across the world, not excluding Indian politics with the advent of Prime Minister Modi in 2014. Erstwhile leader of opposition in the Rajya Sabha, Arun Jaitley, had been meeting US diplomats routinely to lobby for the Bharatiya Janata Party as the original pro-American group in India.</p><p>The conversation published by WikiLeaks explains Mr Modi’s current agenda. Jaitley admitted to a cynical expediency, which the BJP had embraced in order to survive and grow. What was that expediency? As tensions with Pakistan had abated under Singh, the BJP was losing traction in its north Indian base. So complained Jaitley to his diplomat friends.</p><p>In other words, good relations with Pakistan do not suit the BJP. Similarly, he said, in India’s northeast, the talk of Bangladeshi immigrants provided the required oxygen to his party. What Jaitley said then is coming out in bold relief today.</p><p>As for China being in the cross hairs of the BJP, mostly on behalf of you-know-who, the current narrative since May of troops crossing this stream or occupying that hill is like a tale from the tavern. The White House undid the BJP’s doublespeak on China after then prime minister Vajpayee secretly messaged president Clinton that the Pokhran nuclear tests targeted Beijing.</p><p>What is less explicable here is the opposition’s stance, led by the Congress. Are they for a war with China or are they gloating over a stick they may have found to beat a Teflon rival with? Both are unworkable in the absence of ideological clarity. The Lok Sabha monsoon session starting on Thursday presents an opportunity to draw the battle lines with clarity.</p><p>There is needless pessimism over the challenge that Modi presents.</p><p>Public memory is short. The Bihar assembly, going to polls this year, was not won but grabbed from the opposition by subverting an alliance. Was that popular appeal or desperation?</p><p>The BJP did not win Goa, or Madhya Pradesh or Manipur in a democratic contest. For a party that came to power by raising middle class hopes against corruption, the BJP stands accused in Maharashtra and Rajasthan with attempting to gain power through horse-trading. If the media therefore desperately projects Modi as an invincible leader, why should the opposition fall for it?</p><p>There’s a truly imposing challenge, however, and it’s within the opposition parties, chiefly with their self-absorbed leaders. This is where the left parties come be handy with their experience of cobbling steady coalitions. However, for all this to happen, the left needs to stop seeing itself as a victim in West Bengal and Mamata Banerjee as the immediate threat.</p><p>The left and the Congress, ideologically revived under Rahul Gandhi’s leadership, need to sort out their differences in Kerala. The BJP covets both opposition-ruled states, and both face polls next year. Ordinary Indians have shrewdly accepted what was unthinkable until recently — the need for bedtime prayers for the far-right Shiv Sena government in Maharashtra to not get toppled. Some would call it opportunism. Others may see it as ideological clarity. Both are needed for the fight at hand.</p><p>The writer is Dawn’s correspondent in Delhi.</p><p>jawednaqvi@gmail.com</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56e8b4318fb.jpg', 'https://www.dawn.com/news/1578554/to-draw-the-battle-lines-now', 'Jawed Naqvi', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:00', '2020-09-08 16:52:00', 0, 0),
(116, 1, 'Messi back to training after decision to stay with Barca', 'Messi said last week he wasn’t happy with Barca but would rather stay than get into a legal battle with the club.', '<p>BARCELONA: Lionel Messi returned to training with Barcelona on Monday, almost two weeks after he had told the club he wanted to leave.</p><p>After reluctantly changing his mind, Messi was back with the team to prepare for the new season. He practiced separately from the rest of the squad at the Joan Gamper training ground ahead of an evening session, his first under new coach Ronald Koeman, because he still needs to undergo a second coronavirus test before rejoining them.</p><p>Messi said last week he wasn’t happy with Barca but would rather stay than get into a legal battle with the club. Messi wanted to leave for free but the club said the contract clause he invoked had already expired, so he has to stay at least until the end of his contract in June 2021.</p><p>Messi told the club he wanted to leave on August 25 and had not reported for the squad’s required coronavirus testing a week ago. He also had not showed up when his team-mates resumed training last week.</p><p>The return of Barcelona’s embittered captain and greatest ever player may not be an easy one, particularly given some of his closest team-mates are likely to be absent.</p><p>Luis Suarez, Messi’s best friend and neighbour, as well as Arturo Vidal, are expected to join Juventus and Inter Milan respectively.</p><p>His decision to notify the club via burofax that he intended to leave came after he met with Koeman, talks that reportedly involved Dutchman taking a hard line with his top striker.</p><p>Koeman said in his first press conference that he “only wanted players who want to be here and to give everything”.</p><p>Barca, who will be looking to reclaim the La Liga title after surrendering it to Real Madrid last season, are sitting out the first two weeks of the new campaign which begins on Friday due to reaching the Champions League quarter-finals.</p><p>Koeman’s side will instead play pre-season friendlies against Gim­nastic de Tarragona on Saturday and Girona on September 16 before their first league game at home to Villarreal on September 27.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56eac51f75a.jpg', 'https://www.dawn.com/news/1578539/messi-back-to-training-after-decision-to-stay-with-barca', 'Agencies', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:03', '2020-09-08 16:52:03', 0, 0),
(117, 1, 'Misbah regrets not winning Test series and T20s in England', '“Our mistakes are quite visible and our inexperienced bowling was exposed when it was attacked.\"', '<p>LAHORE: Pakistan cricket team’s head coach and chief selector Misbah-ul-Haq on Monday expressed regret over the results of the recently concluded series against England but claimed that the team is on the right track and will soon overcome the shortcomings that have been noticed on the tour, especially in the bowling department.</p><p>“The tour of England was very important for not only Pakistan and England but the entire cricketing world in the backdrop of the Covid-19 pandemic,” said Misbah while addressing a presser at the Gaddafi Stadium on Monday. “When I summarise this tour, then as a team and as a coach, we regret the results that we ended up with. For me, the result in the Test series should have been 1-0 in Test and 2-0 in T20 in Pakistan’s favour. But we did not achieve that and that will always remain a regret.”</p><p>It may be mentioned here that Pakistan lost the Test series to England 1-0 while the T20 series ended at 1-1 with the first match washed out. Rain had a major part to play in curtailing the matches and did not allow the teams to play consistent cricket throughout.</p><p>‘We have to give time to our young pacers to come good’</p><p>“Overall, we should look back in terms of cricket we played in hard times (due to Covid-19). How we prepared from zero level to play very competitive cricket. Thirty players were in England without much preparations and now see our performance in that backdrop,” said Misbah, while defending the team’s performance.</p><p>“We dominated most sessions of the first Test (before losing it) and we set 190 plus targets for England twice and we also defended in the third T20 and which is appreciable because we fought back after being one match down,” he said.</p><p>To a question Misbah said that everyone plays to win but sometime something goes wrong when you are on the verge of victory. After that one can only look to make amends and not repeat mistakes in the future games.”</p><p>“Our mistakes are quite visible and the inexperienced bowling attack was exposed when it was attacked, especially at that crucial stage at Old Trafford when we were so close to victory. But as our bowlers are young, we have to give them time to be matured with the passage of time. Asking these young guns to put up performances like James Anderson and Stuart Broad is not fair really,” he said.</p><p>When reminded that Pakistan’s standing in world cricket rankings is poorer in all three formats now ffrom the time he took over a year ago, Misbah defended himself and said: “If anyone says the team has started losing now, I would like to tell them that before I joined it and despite being at the top of the world T20 rankings, Pakistan lost to South Africa and England.”</p><p>“Look unfortunately, our top performers in T20 like Fakhar Zaman, Hasan Ali and Shadab Khan - whose roles were vital in bringing Pakistan atop in T20 rankings - have all gone through a bad patch and that has resulted in bringing Pakistan down in the shorter format. But the way we played against England in the T20s is heartening because we have shown spark and this team will go better and better with the passage of time,” said Misbah.</p><p>Asked why he was not consulted by the Pakistan Cricket Board (PCB) in the appointment of six provincial cricket team coaches recently and whether it is an indirect message to him that he may soon be relieved from his job as chief selector, Misbah said:”I was busy on a very important tour and I was not in touch with the PCB. But as the time is short, these appointments were necessary to be made as domestic season will be commencing soon.”</p><p>“Now I will sit with Nadeem Khan (Director National High Performance Centre) to have a briefing on the entire process,” he added.</p><p>When queried that one of the newly-appointed coaches Faisal Iqbal, a former Test cricketer, had criticised him in the past so how does he foresee working with him, Misbah said in a professional set up it was essential to work for the future by ignoring the past.</p><p>“We have played together but now we have to work on professional lines which just requires us to have a look at the performance of each official in their new roles,” he said.</p><p>Misbah, who remains Pakistan’s most successful captain, also negated the impression that Babar Azam as T20 captain had no free hand in taking decisions. “Babar is a powerful captain, having the authority to take the decisions on his own. I believe until a captain does not take independent decisions, he can’t learn the ropes fast enough.”</p><p>To several questions regarding mistakes made in picking the playing XI for matches in England, Misbah said selection is always made keeping in view the circumstances and conditions and not just by preferring any individual.</p><p>To a question Misbah said three seniors players - Muhamamd Hafeez, Shoaib Malik and Wahab Riaz - had the capability to continue till the next year’s T20 World Cup. “Hafeez and Wahab have proved that with their last two years’ performances while Shoaib has all the talent required for the modern day cricket,” he said.</p><p>“The big job for us is to pick a team with a right balance and that we will achieve before the World Cup 2021,” he predicted.</p><p>He praised the young fast bowling pair of Nasim Shah and Shaheen Shah Afridi, declaring them as the best fast bowlers of their age inn international cricket.</p><p>Asked if former skipper Sarfaraz Ahmad had played his farewell match (3rd T20 against England) as he was given a chance in place of prolific wicket-keeper Mohammad Rizwan, Misbah strongly denied the impression: “You can’t sideline a cricketer on the performance of just one match. He did a good job on the tour, doing a lot of hard work in training sessions and intra-squad matches. But Rizwan is our number one choice at the moment and after him Sarfaraz is the second best keeper and has enough cricket left in him to contribute in future series,” observed Misbah.</p><p>He also did not did not agree with the question that the heavy support staff was not handling things adequately. “It is not an easy job to handle 30 players on such a long tour. The experience support staff in fact proved beneficial in conducting the training..”</p><p>To a question he said he could not determine what the critics term as defensive or aggressive approach in cricket. “When a team scores 190-plus runs in T20 cricket, if a team decides to bat first after winning the toss in English conditions, and when you make three changes after losing a Test, is that a defensive or aggressive approach?” asked Misbah.</p><p>To a question about Asad Shafiq’s poor run with the bat in the Test series, the former captain said unfortunately the middle-order batsman was going through a bad patch but he still had a significant role to play in the Pakistan team.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56eaf0d81d5.jpg', 'https://www.dawn.com/news/1578542/misbah-regrets-not-winning-test-series-and-t20s-in-england', 'Mohammad Yaqoob', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:06', '2020-09-08 16:52:06', 0, 0),
(118, 1, 'Tokyo Olympics will go ahead with or without Covid: Coates', '“Now very much these will be the Games that conquered Covid, the light at the end of the tunnel,\" says official.', '<p>SYDNEY: Tokyo’s postponed Olympics will go ahead next year regardless of the novel coronavirus pandemic, International Olympic Committee (IOC) vice-president John Coates said on Monday, vowing they will be the ‘Games that conquered Covid’.</p><p>The Olympics have never been cancelled outside of the world wars and Coates, speaking in an exclusive interview, was adamant that the Tokyo Games will start on their revised date.</p><p>“It will take place with or without Covid. The Games will start on July 23 next year,” said Coates, who heads the IOC’s Coordination Commission for the Tokyo Games.</p><p>“The Games were going to be, their theme, the Reconstruction Games after the devastation of the tsunami,” he said, referring to a catastrophic earthquake and tsunami in northeastern Japan in 2011. “Now very much these will be the Games that conquered Covid, the light at the end of the tunnel.”</p><p>In a landmark decision, the 2020 Olympics were postponed because of the global march of the pandemic and they are now set to open on July 23, 2021.</p><p>But Japan’s borders are still largely closed to foreign visitors and a vaccine is months or even years away, feeding speculation about whether the Games are feasible at all.</p><p>Japanese officials have made clear they would not delay them a second time beyond 2021.</p><p>There are signs that public enthusiasm in Japan is waning after a recent poll found just one in four Japanese want them to go ahead next year, with most backing either another postponement or a cancellation.</p><p>Coates said the Japanese government ‘haven’t dropped the baton at all’ following the postponement, despite the ‘monumental task’ of putting the event back a year.</p><p>“Before Covid, [IOC president] Thomas Bach said this is the best prepared Games we’ve ever seen, the venues were almost all finished, they are now finished, the village is amazing, all the transport arrangements, everything is fine,” he said. “Now it’s been postponed by one year, that’s presented a monumental task in terms of re-securing all the venues... something like 43 hotels we had to get out of those contracts and re-negotiate for a year later.</p><p>“Sponsorships had to be extended a year, broadcast rights.”</p><p>With much of that work underway, or accomplished, a task force has been set up to look at the different scenarios in 2021 — from how border controls will affect the movement of athletes, to whether fans can pack venues and how to keep stadiums safe.</p><p>The group, comprising Japanese and IOC officials, met for the first time last week.</p><p>“Their job now is to look at all the different counter-measures that will be required for the Games to take place,” said Coates, the long-time president of the Australian Olympic Committee.</p><p>“Some countries will have it [Covid] under control, some won’t. We’ll have athletes therefore coming from places where it’s under control and some where it is not.</p><p>“There are 206 teams... so there’s a massive task being undertaken on the Japanese side.”</p><p>Tokyo 2020 chief Toshiro Muto repeated last Friday that organisers hoped to avoid the Games without spectators — an option that has been mooted given Japan is still limiting audiences at sports events.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f571af630586.jpg', 'https://www.dawn.com/news/1578545/tokyo-olympics-will-go-ahead-with-or-without-covid-coates', 'AFP', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:10', '2020-09-08 16:52:10', 0, 0),
(119, 1, 'Vetter lands second best ever javelin throw', 'Former world champion Johannes Vetter\'s throw was more than three metres further than his previous personal best.', '<p>CHORZOW (Poland): Former world champion Johannes Vetter launched the second best javelin throw in history on Sunday with an effort of 97.76 metres at an athletics meet in Poland.</p><p>At the Continental Tour Gold level event in Chorzow, 27-year-old Vetter, who won gold at the 2017 worlds in London, came to less than a metre of three-time Olympic champion Jan Zelezny’s 1996 world record of 98.48m.</p><p>“I don’t really know what to say, in javelin there are little details that make it possible to make very good throws, when everything fits perfectly,” said Vetter. “With a headwind I could have gone much further, maybe close to 100m, but I think I showed that you can also throw very far in a closed stadium like this.”</p><p>German Vetter’s throw was also more than three metres further than his previous personal best, and moves him nearly four metres ahead of the next best throw, compatriot Thomas Rohler’s effort of 93.90m in 2017.</p><p>Vetter was fourth at the Rio Olympics in 2016 and third at the worlds in Doha in 2019.</p><p>He has been in impressive form this season with a throw of 91.49m on Aug 11 in Turku, Finland.</p><p>Even after his victorious throw on Sunday, he even allowed himself to throw 94.84m on his fourth attempt, the sixth best performance in history.</p><p>After his 2017 world title, Vetter’s progress slowed over the last two years due to a persistent left ankle injury where a piece of bone moved freely.</p><p>That required injections before each competition.</p><p>Operated four days after the worlds in Doha last October, he resumed training at the end of November.</p><p>His next event will be on Tuesday in Dessau, Germany, followed by Berlin on Sept 13.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56eb74435f9.jpg', 'https://www.dawn.com/news/1578551/vetter-lands-second-best-ever-javelin-throw', 'AFP', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:13', '2020-09-08 16:52:13', 0, 0),
(120, 1, 'Record-breaker Fati stars in Spain rebuild', 'The 17-year-old Barcelona forward put Spain three goals ahead of Ukraine after just 31 minutes of the League A, Group 4 clash.', '<p>PARIS: Their youngest-ever scorer and two goals from a captain twice his age. Spain couldn’t ask for more from their rebuild.</p><p>The 17-year-old Barcelona forward Ansu Fati scored in Sunday’s 4-0 Nations League win over Ukraine and won a penalty for 34-year-old Sergio Ramos too as an influx of young talent blended well with experienced stalwarts.</p><p>Fati put Spain three goals ahead after just 31 minutes of the League A, Group 4 clash at the empty Alfredo di Stefano Stadium in Madrid with a fine individual strike that came amid a scintillating debut start for his adopted country.</p><p>Aged 17 years and 311 days, Fati, who was born in Guinea-Bissau and obtained Spanish nationality a year ago after moving to Spain when he was seven, beat the previous record held by Juan Errazquin, who scored three goals aged 18 against Switzerland in 1925.</p><p>“As soon as I was showered and changed I called my family - they are the people who have helped me reach this day and who always help me overcome challenges,” Fati said after the match.</p><p>“I’ll ask all the guys to sign this Spain shirt and it’ll go up on the wall in a special place in my house.”</p><p>Spain go top of their Nations League group by a point from Ukraine. Germany, who drew 1-1 with Switzerland on Sunday, are third.</p><p>Spain had been fortunate to avoid defeat Thursday when José Gayà salvaged a 1-1 draw with Germany, but the win over Ukraine was never in doubt. After less than two minutes Fati was fouled in the penalty area and Ramos scored the resulting spot-kick.</p><p>Ramos headed in a second goal to send the defender eighth on Spain’s all-time scorers list with 23, and Fati made Spain’s control complete with his long-range shot.</p><p>Substitute Ferran Torres completed the rout five minutes from the end.</p><p>“[Spain coach Luis Enrique] will have a difficult time picking lineups because these players are very young, now have experience, and all of them can play,” Ramos said. “The important thing is to gradually build a solid team for what lies ahead.”</p><p>GERMANY DISAPPOINT</p><p>The Nations League just isn’t Germany’s competition.</p><p>The draw with Switzerland left Germany still chasing their first win after their sixth game in Europe’s newest competition.</p><p>Ilkay Gundogan gave Germany the lead with a low drive in the 14th minute but Swiss right-back Silvan Widmer beat Bernd Leno to equalise for the hosts just before the hour mark behind closed doors in Basel.</p><p>The away side started strongly but the hosts began pouring forward soon after going behind, with Benfica forward Haris Seferovic hitting the post for the Swiss just before half-time.</p><p>Germany had Leno to thank they earned a point, with the Arsenal man making a string of good saves, in particular from a well-struck free-kick from his Gunners team-mate Granit Xhaka five minutes before the end.</p><p>Liverpool full back Neco Williams scored the winning goal in his second game for Wales in League B.</p><p>Williams struck deep into second-half injury time in a 1-0 win over Bulgaria as Wales kept their perfect record in Group 4.</p><p>They are three points ahead of Finland who earned a 1-0 win over the Republic of Ireland in Dublin thanks to Fredrik Jensen’s strike just seconds after coming on midway through the second half.</p><p>Russia carried on their strong start in League B with a 3-2 win over Hungary in Budapest.</p><p>The Russians have won 10 of their last 11 games and take top spot in Group 3, three points ahead of the Hungarians.</p><p>The Nations League format keeps teams of similar competitive strength together. That helped the Faroe Islands earn back-to-back wins in competitive games for the first time since 1997 by beating Andorra 1-0 to follow up a 3-2 win over Malta on Thursday.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56eba2069eb.jpg', 'https://www.dawn.com/news/1578553/record-breaker-fati-stars-in-spain-rebuild', 'Agencies', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:17', '2020-09-08 16:52:17', 0, 0);
INSERT INTO `articles` (`id`, `newspaper_id`, `title`, `excerpt`, `body`, `thumbnail`, `link`, `publisher`, `published_on`, `views`, `polarity`, `is_active`, `added_by`, `created_at`, `updated_at`, `updateCount`, `ratedFor`) VALUES
(121, 1, 'Shallwani’s appointment as city administrator a consensus decision, claims Sindh governor', 'MQM-P voices concern, asks CJP to take notice of decision to appoint ‘non-residents’ as administrators.', '<p>KARACHI: While the Muttahida Qaumi Movement-Pakistan, a key coalition partner of the federal government and one of Karachi’s political stakeholders, raised serious concerns over appointment of “non-local officers” as heads of local governments in urban parts of the province, Sindh Governor Imran Ismail on Monday disclosed that the appointment of former commissioner Iftikhar Shallwani as administrator of Karachi was a consensus decision of “all stakeholders”.</p><p>The governor’s claim came during his meeting with Mr Shallwani who met him at Governor House and discussed issues pertaining to Karachi’s affairs and municipal administration.</p><p>The governor said Mr Shallwani would meet the challenges and perform his duties in line with merit and fulfil his responsibilities.</p><p>“During the meeting the Sindh governor apprised the Karachi administrator that he was appointed with a consensual decision of all the stakeholders,” said a statement issued by Governor House after the meeting. “The governor expressed his confidence that the administrator would utilise all his ability and capacity for resolving Karachi’s issues in his administrative tenure and prove his skills.”</p><p>MQM-P asks CJP to take notice of appointment of ‘non-residents’ as administrators</p><p>The governor also referred to the “historic” Rs1.1 trillion package announced by Prime Minister Imran Khan under the Karachi Transformation Plan to resolve the lingering and chronic issues of the city that included plans for supply of water, cleaning of drains and nullahs, building new sewerage system, solid waste disposal programme and introducing a mass transport system.</p><p>“This package will help resolve key infrastructure and development issues of the city. In the past, the governments ignored the areas of developments and provision of basic amenities. The federal government is committed to fix all the past mistakes and bring Karachi among the best cities of the world,” the governor said.</p><p>Mr Shallwani expressed his gratitude to the governor and vowed to meet all challenges through merit and honesty.</p><p>He also assured the governor of all-out efforts to fix the city’s issues under his administrative tenure.</p><p>The provincial government had last week appointed Mr Shallwani as the administrator of Karachi.</p><p>MQM-P voices concerns</p><p>Though Mr Shallwani’s appointment emerged as a result of discussions between the Pakistan Peoples Party (PPP) government in Sindh and the federal government of Pakistan Tehreek-i-Insaf, the MQM-P, a key partner of the PTI in the centre and one of the main political players in Karachi, called the move an injustice and discrimination on ethnic grounds.</p><p>“The MQM-P strongly condemns the decision to appoint non-resident officers as administrators in cities of Sindh including Karachi,” said the coordination committee of the party in a statement.</p><p>“The chief justice of Pakistan and people at the helm of affairs should take notice of such a move that kills merit and discriminates among people only on ethnic grounds. Such a decision would further increase the sense of deprivation among the people of urban Sindh,” the committee added.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f57163be1aa0.jpg', 'https://www.dawn.com/news/1578527/shallwanis-appointment-as-city-administrator-a-consensus-decision-claims-sindh-governor', 'Imran Ayub', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:21', '2020-09-08 16:52:21', 0, 0),
(122, 1, 'Police detain 12 suspects in girl’s rape-cum-murder case', 'PTI lawmaker criticises police for the \"traditional manner\" in which they dealt with the kidnapping.', '<p>KARACHI: Police on Monday detained a dozen suspects in the rape-cum-murder case of a five-year-old girl in PIB Colony on Sunday and expanded the scope of the investigation by collecting DNA samples of the suspects.</p><p>Area residents who blocked the main University Road for hours on Sunday have given a three-day ultimatum to the authorities for arrest of the culprits.</p><p>Separately, Opposition Leader in the Sindh Assembly Firdous Shamim Naqvi with several MPAs of the PTI met the family of the deceased girl and assured them of raising the issue before higher authorities for the provision of justice.</p><p>The Karachi police chief, Additional Inspector General Ghulam Nabi Memon, told Dawn that “we are working on it but so far the accused has not been identified”.</p><p>Mr Memon added: “All efforts are directed to carry out DNA of the suspects.”</p><p>According to relatives, the girl came out of her home near old Sabzi Mandi on Friday at around 7am to buy biscuits from a neighbouring shop when she was kidnapped. The family lodged her missing report at the police station the same day. Her body wrapped in a piece of cloth was found on a garbage dump in the same locality early on Sunday morning.</p><p>Police surgeon Dr Qarar Ahmed Abbasi said that the minor girl was subjected to criminal assault before being murdered. He said she suffered head injuries caused by hard and blunt instruments. The police surgeon said that she was not torched.</p><p>On Sunday, police detained a suspect, said to be a neighbour, whose DNA samples were taken and sent to a lab at Karachi University.</p><p>A delegation of PTI lawmakers led by Mr Naqvi on Monday visited the area and met the family.</p><p>PTI legislator Jamal Siddiqi, who is elected from the same locality and was part of the delegation, told Dawn that DIG-East Nouman Siddiqi informed them that over a dozen persons had been detained for interrogation whose DNA samples had also been taken and sent to the KU lab to see if they were involved in the gruesome incident.</p><p>The lawmaker revealed that the investigators had still not received the lab report of the one suspect who was detained on Sunday. He said they assured the grieving family that they would take up this issue before the Sindh chief minister and inspector general of police, and justice would be served.</p><p>The PTI lawmaker said that it was a highly congested locality from where the girl was kidnapped. It was not possible for outsiders to go there and kidnap the girl, said the lawmaker.</p><p>Mr Siddiqi criticised the police for the “traditional manner” with which they dealt with the kidnapping case of the girl and did not take it seriously when the FIR was lodged by the family.</p><p>Man dies</p><p>A 37-year-old factory worker died when a machine roller hit him in the Landhi area on Monday, police said. They added that Mohammed Israel was working in a dry cleaning factory near Murtaza Chowrangi. He was standing at some distance when a roller separated from the machine and fell on his head. He sustained critical injuries and died.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f571570ece34.jpg', 'https://www.dawn.com/news/1578528/police-detain-12-suspects-in-girls-rape-cum-murder-case', 'Imtiaz Ali', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:28', '2020-09-08 16:52:28', 0, 0),
(123, 1, 'Changes in Sindh LG law demanded to make KMC city’s chief civic authority', 'Civil society group calls upon authorities to conduct a new census in metropolis.', '<p>KARACHI: Speakers at a seminar on Monday demanded that the Sindh Local Government Act 2013 be amended and the Karachi Metropolitan Corporation be made empowered so that it functioned as the chief civic authority of the city.</p><p>They also demanded that the KMC be made part of the Provincial Coordination Implem­en­ta­tion Committee (PCIC) so that the city was able to benefit from the Rs1.1 trillion package announced by Prime Minister Imran Khan.</p><p>The demands were made at the seminar, ‘Why is Karachi, Pakistan’s megapolis an abandoned city’, organised by the Karachi Citizens’ Forum (KCF).</p><p>Aggrieved citizens shared the ordeal that they went through since the Aug 27 rainfall — with hunger, job losses and damaged homes amid the Covid-19 pandemic dominating the narrative.</p><p>Welcoming the formation of the PCIC from its original three political parties to include the other stakeholders and the land-owning authorities of Karachi plus the army, the KCF urged for transparency and demanded to know who will undertake the accountability of monitoring the expenditures and execution of the programme and if the public-private partnership will include qualified urban planners and members of industry.</p><p>A civil society group calls upon authorities to conduct a new census in Karachi</p><p>Moderating the session, KCF convener Nargis Rehman stressed that 19 civic agencies needed to be included in the Karachi master plan and called for an audit of records.</p><p>She acknowledged the positive role of the army when it came to rescue and relief operations, noting that “it’s the only institution that helps when disaster strikes”.</p><p>Khalid Mehmood, a resident of Korangi, said the area was not cleaned since Eidul Azha. “The offal are lying there and then add to it rainwater. Currently, many places in the area have two to three feet of stagnant water,” he said, adding that citizens suffered huge financial losses.</p><p>A social worker from Malir, Mastajeeb Abbas, said hunger was overlooked in all relief efforts. He said the people in the area, like most parts of the city, were suffering due to Covid-19 pandemic and the rains just compounded their troubles.</p><p>“There were people trying to save TV sets which they had purchased for their daughters’ dowry,” he added.</p><p>Abdul Jalil Durrani, a local political worker from the Mauripur area, said they had to breach the Hawkesbay Road at some points to let the water drain.</p><p>“Too much water was accumulating and we had to do it. I was taking photographs of the area to mobilise some rescue operations. I saw a lady having labour pains while the entire area was surrounded by water. Mera zameer gawara nahi kiya tasweer lene ka, there was so much helplessness,” he said as the room went silent.</p><p>Haris Askani from Lyari said he was able to mobilise help. He said the area had schools but no teachers, hospitals but no doctors. “Lyari has become synonymous with gang war and this is so wrong,” he said while demanding that things must be improved in his area.</p><p>‘SBCA, Sepa responsible for Naya Nazimabad disaster’</p><p>A resident of Naya Nazimabad said his house was submerged in rainwater since 15 days.</p><p>“The army came to drain the water, so did Edhi and others. Everyone tried but gave up. We have been living in our relatives’ homes for two weeks now,” he said, adding that 30 per cent of the area was still submerged in eight to 10 feet of water.</p><p>Some members asked him if he knew there was a lake on the site which was reclaimed to which he said no. However, the forum unanimously agreed that rather than blaming the residents of Naya Nazimabad, the builders, officials of the Sindh Building Control Authority and Sindh Environmental Protection Agency must be held accountable.</p><p>Earlier, former MPA Mehtab Rashdi shared the woes of DHA residents, including her personal experience with flooding in the recent rains.</p><p>Former Sindh governor retired Lt Gen Moinuddin Haider asked why there was no planning done when there were forecast of heavier than usual rains.</p><p>“Why weren’t they planning for it? Why were they waiting for a disaster,” he questioned.</p><p>On the occasion, former Sindh governor Kamal Azfar asked that how can a repeat of this disaster be prevented in future.</p><p>Former Citizens-Police Liaison Committee (CPLC) chief Nazim Haji gave a detailed breakdown of the issues and mafias that were destroying industrial areas in Karachi.</p><p>“Either we decide to suffer in silence or we speak up. We need to step out and demand our rights, not sit in the drawing rooms and talk,” he said.</p><p>The seminar noted that people were marooned in their homes in stinking sewage without electricity and gas, medical aid and proper food for weeks.</p><p>Former Nespak chairman Asad Ali Khan, Pakistan Medical Association secretary general Dr Qaiser Sajjad and stockbroker Muzamil Khan also spoke at the event.</p><p>Fresh census for Karachi demanded</p><p>Demanding transparency and accountability, the KCF noted that if the Rs1.1tr package was meant to procure a meaningful result, all loose ends must be sorted out.</p><p>The forum called for a new Karachi census along with control on migrant entry.</p><p>“Control on land developer and land development, eliminations of ghost employees and foreign consultants, utilization of our eminent urban planners, architects who have been working and advising for decades on city’s fault lines, names and responsibilities of the PCIC should be clearly delineated along with the names of the monitoring agencies, project development report should be made public and oversights such as air and coastal pollution, rain harvesting and mangrove protection must be included in the development programme,” are the other demands of the KCF.</p><p>“When the 18th Amendment was passed we welcomed the autonomy and authority given to the provinces whose assemblies and government were elected. On that very same principle of democracy we demand that the Karachi megapolis should have a Karachi Metropolitan Corporation with an elected mayor, the metropolitan corporation be given empowerment autonomy, authority, to discharge all municipal functions of the city with all the necessary financial allocations, heading the KWSB and the KSWMB and the seven Karachi DMCs and all union councils. As it is an elected body of the locals elected by the locals it would be far more effective in ordering the municipal services delivery then bureaucrats who have temporary postings and cannot relate to the problems of the local,” the KCF said in its resolution.</p><p>Published in Dawn, September 8th, 2020</p>', '/images/newspapers/thumbnails/5f56e9dbe1525.jpg', 'https://www.dawn.com/news/1578529/changes-in-sindh-lg-law-demanded-to-make-kmc-citys-chief-civic-authority', 'Sumaira Jajja', 'Updated 08 Sep 2020', 0, '0', 1, 'system', '2020-09-08 16:52:32', '2020-09-08 16:52:32', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2020_03_15_101517_create_newspapers_table', 1),
(14, '2020_03_17_111517_create_articles_table', 1),
(15, '2020_03_21_025803_create_polarities_table', 1),
(16, '2020_03_21_165056_create_actors_table', 1),
(17, '2020_03_22_060006_create_nouns_table', 1),
(18, '2020_03_24_103523_create_node_settings_table', 1),
(19, '2020_09_05_105433_add_isadmin_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infoDomain` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalArticles` int(11) NOT NULL DEFAULT 0,
  `totalViews` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `updateCount` int(11) NOT NULL DEFAULT 0,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `name`, `link`, `thumbnail`, `infoDomain`, `totalArticles`, `totalViews`, `is_active`, `updateCount`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'Dawn', 'https://www.dawn.com/latest-news', 'abc', 'abc', 0, 0, 1, 0, 1, '2020-09-04 15:04:04', '2020-09-04 15:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `node_settings`
--

CREATE TABLE `node_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `newspaper_id` bigint(20) UNSIGNED NOT NULL,
  `article` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_on` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `node_settings`
--

INSERT INTO `node_settings` (`id`, `newspaper_id`, `article`, `link`, `title`, `body`, `thumbnail`, `publisher`, `published_on`, `created_at`, `updated_at`) VALUES
(1, 1, 'article,nigga', 'h2 > a', '.template__header > .story__title,.template__header > .flex > .flex__item > h2 > a,.story__title > .story__link', '.story__content', 'figure > .media__item > picture > img,picture > img', '.story__byline__link,.story__authors__name > a', '.story__time', '2020-09-04 15:04:04', '2020-09-04 15:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `nouns`
--

CREATE TABLE `nouns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `noun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polarities`
--

CREATE TABLE `polarities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `system` enum('PHPSentimentAnalyzer','PHPInsight') COLLATE utf8mb4_unicode_ci NOT NULL,
  `positive` double(8,2) NOT NULL DEFAULT 0.00,
  `negative` double(8,2) NOT NULL DEFAULT 0.00,
  `neutral` double(8,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updateCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Abc12345', 'Abc12345@gmail.com', NULL, '$2y$10$hxUY3l6Bips8zmPZLoP1vO4SSfIEZs/DkZNjQtwtEJVmYSiT1aEzm', NULL, '2020-09-04 14:55:24', '2020-09-04 14:55:24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_newspaper_id_foreign` (`newspaper_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `node_settings`
--
ALTER TABLE `node_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `node_settings_newspaper_id_foreign` (`newspaper_id`);

--
-- Indexes for table `nouns`
--
ALTER TABLE `nouns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nouns_article_id_foreign` (`article_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `polarities`
--
ALTER TABLE `polarities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `polarities_article_id_foreign` (`article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `node_settings`
--
ALTER TABLE `node_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nouns`
--
ALTER TABLE `nouns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polarities`
--
ALTER TABLE `polarities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_newspaper_id_foreign` FOREIGN KEY (`newspaper_id`) REFERENCES `newspapers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `node_settings`
--
ALTER TABLE `node_settings`
  ADD CONSTRAINT `node_settings_newspaper_id_foreign` FOREIGN KEY (`newspaper_id`) REFERENCES `newspapers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nouns`
--
ALTER TABLE `nouns`
  ADD CONSTRAINT `nouns_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `polarities`
--
ALTER TABLE `polarities`
  ADD CONSTRAINT `polarities_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
