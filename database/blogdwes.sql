-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 11:05 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogdwes`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateTime` datetime NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `post`, `dateTime`, `author`, `content`) VALUES
('3Z79Su1MSR2OUOu', 'tcn3RvWsW6', '2019-01-13 17:05:00', 'mikel@gmail.com', 'Great informative article.'),
('DXoz2waVjh4AqG7', 'R3Pe0JzQiE', '2019-01-13 16:43:00', 'jack@gmail.com', 'I get paid 85 USD hourly working online from home. I never thought that itâ€™s possible but my sisterâ€™s friend, Maria L. Keller from Jeffersonville, who is a mom, pockets in $10K a month by working on this same job and she showed me exactly what she doe'),
('FYvlnEjUTzndsGX', 'R3Pe0JzQiE', '2019-01-13 16:43:00', 'mikel@gmail.com', 'Iâ€™m positive the techcrunch reading demographic is extremely interested in this lucrative not-a-scam opportunity.'),
('h1z8XfLmy9ysXun', 'zJEowufACI', '2019-01-13 17:01:00', 'jack@gmail.com', 'I never thought that itâ€™s possible but my sisterâ€™s friend, Maria V. Keller from Jeffersonville, who is a mama with two kids at home, brings in $10grands monthly by working on this same job and she showed me exactly what she does.'),
('hhh', 'bas8rx76a', '2011-10-10 10:00:00', 'danielalarconcuesta@gmail.com', 'Primer comentario'),
('jVDczgO5P9Fh9W3', 'BlIBgyERkI', '2019-01-13 16:58:00', 'mikel@gmail.com', 'Thanks for reporting on this. It is gross and ugly and we donâ€™t like to talk about it as a society because far too many people use porn on a regular basis. I would love to see some kind of index or rating for the major search engines regarding safety an'),
('Maj3I4DB3aK2qIA', 'Qb3TKaamOt', '2019-01-16 14:02:00', 'mauricio@gmail.com', 'OMG I love it:0'),
('mv7mQfubFrkFL35', 'oWUqsU0wzt', '2019-01-13 16:39:00', 'jack@gmail.com', 'I remember that game well, too.\r\n\r\nI used to literally beat DL with my eyes closed and went around various places and beating it while looking away or blindfolded or just with my eyes firmly closed'),
('NjrVJR1r5dSi4eG', 'pNw02uh1V4', '2019-01-13 16:34:00', 'mikel@gmail.com', 'Valero Energy fired My neighborâ€™s girlfriend AlisonM. Arias in New Rochelle but she now brings in $11910 from home, just by working on this..\r\n'),
('NvvmTBw3XhN5DQE', '6rJjUQTWGl', '2019-01-13 16:26:00', 'mikel@gmail.com', 'Andersons fired my good friendâ€™s girlfriend Alison Arias in Winona but she now brings in $11910 from home, just by working over this site.. New York Daily Report'),
('QanXWbppJU8KApJ', 'P00xTDC7G', '2019-01-13 16:55:00', 'jack@gmail.com', '2 seperate issues:\r\nReach out to startup founders and execs about their experiences with their attorneys under its own heading Blurred lines here?'),
('qw25RI6bAAKXAhX', 'mMFWLvqcMu', '2019-01-13 16:46:00', 'mikel@gmail.com', 'When would these high profies get time to prepare and interview in between their busy jobs? Or is it that companies have hypocritical interview process for engineering(which needs tons of prep) & managerial/executive levels?'),
('rTDV5cRf2BR7lx8', 'bas8rx76a', '2019-01-09 20:02:00', 'danielalarconcuesta@gmail.com', 'polo'),
('x7k8LJSSTmjvXl', 'bas8rx76a', '2019-01-09 19:36:00', 'danielalarconcuesta@gmail.com', 'tercero'),
('Yd3GHSvjTW5bH1', 'bas8rx76a', '2019-01-16 18:39:00', 'jorge@gmail.com', 'mauri se va a cocinar un poquito');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateTime` datetime NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `labels` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `dateTime`, `content`, `title`, `labels`, `author`, `image`) VALUES
('6rJjUQTWGl', '2018-05-13 16:22:32', 'The government shutdown entered its 21st day on Friday, upping concerns of potentially long-lasting impacts on the U.S. stock market. Private market investors around the country applauded when Uber finally filed documents with the SEC to go public. Others were giddy to hear Lyft, Pinterest, Postmates and Slack (via a direct listing, according to the latest reports) were likely to IPO in 2019, too.\r\n\r\nUnfortunately, floats that seemed imminent may not actually surface until the second half of 2019 â€” that is unless President Donald Trump and other political leaders are able to reach an agreement on the federal budget ASAP.  This week, we explored the governmentâ€™s shutdownâ€™s connection to tech IPOs, recounted the demise of a well-funded AR project and introduced readers to an AI-enabled self-checkout shopping cart.\r\n\r\n1. Postmates gets pre-IPO cash\r\n\r\nThe company, an early entrant to the billion-dollar food delivery wars, raised what will likely be its last round of private capital. The $100 million cash infusion was led by BlackRock and valued Postmates at $1.85 billion, up from the $1.2 billion valuation it garnered with its unicorn round in 2018.\r\n\r\n2. Uberâ€™s IPO may not be as eye-popping as we expected\r\n\r\nTo be fair, I donâ€™t think many of us really believed the ride-hailing giant could debut with a $120 billion initial market cap. And can speculate on Uberâ€™s valuation for days (the latest reports estimate a $90 billion IPO), but ultimately Wall Street will determine just how high Uber will fly. For now, all we can do is sit and wait for the company to relinquish its S-1 to the masses.\r\n\r\n3. Deal of the week\r\n\r\nN26, a German fintech startup, raised $300 million in a round led by Insight Venture Partners at a $2.7 billion valuation. TechCrunchâ€™s Romain Dillet spoke with co-founder and CEO Valentin Stalf about the companyâ€™s global investors, financials and what the future holds for N26.\r\n\r\n4. On the market\r\n\r\nBird is in the process of raising an additional $300 million on a flat pre-money valuation of $2 billion. The e-scooter startup has already raised a ton of capital in a very short time and a fresh financing would come at a time when many investors are losing faith in scooter startupsâ€™ claims to be the solution to the problem of last-mile transportation, as companies in the space display poor unit economics, faulty batteries and a general air of undependability. Plus, Aurora, the developer of a full-stack self-driving software system for automobile manufacturers, is raising at least $500 million in equity funding at more than a $2 billion valuation in a round expected to be led by new investor Sequoia Capital.', 'Startups Weekly: Will Trump ruin the unicorn IPOs of our dreams?', 'Trump ', 'danielalarconcuesta@gmail.com', 'images/2018/May/6rJjUQTWGl.jpg'),
('bas8rx76a', '2019-01-05 09:25:00', 'Jonathan Teo,  long a Bay Area venture capitalist, might be regretting having a Twitter account tonight. The reason: it was used to serve a summons to Teo by the law firm Baker Curtis & Schwartz, which represents a former employee of the early-stage venture firm Teo had cofounded in 2014, Binary Capital. \r\n \r\n The plaintiff is Ann Lai,  who joined Binary in 2015. Her role at the firm, according to her complaint, was to be \"primarily\" responsible for establishing [Binary\'s] data-driven sourcing strategy, conducting the diligence regarding their potential investments, and supporting their portfolio companies on analytics/growth strategies.\" Yet Lai, who has three Harvard degrees, says that she battled discrimination and harassment on the job \"almost from the day she started work,\" according to her lawsuit. \r\n \r\n Among Lai\'s grievances: that Teo and firm cofounder Justin Caldbeck \"requested and received headshots of female applicants that they sought to hire, and assessed these headshots for attractiveness. They also searched the applicants\' social media profiles to determine their relative hotness. The complaint also states the Teo, Caldbeck, and Binary, which the two controlled, \"expressed a desire to hold a company retreat, without significant others, at a location in which no one would wear clothes. The lurid details go on. \r\n \r\n Ultimately, states the complaint - which was originally filed by Lai\'s attorneys in 2017 and amended back in September - Lai was denied benefits, opportunities, and compensation owed to her because she pushed back against such conduct. She was also forced to resign and was defamed by both Caldbeck and Teo in the aftermath of her departure, says the suit, which seeks civil penalties. \r\n \r\n The Information first reported in June of 2017 that, according to half a dozen women in the tech industry, Caldbeck had made unwanted advanced toward them. He resigned shortly afterward, while Teo fought unsuccessfully to keep Binary a going concern. \r\n \r\n What happens next remains to be seen, but it\'s certainly interesting that Lai\'s attorneys used social media to reach Teo. They had no choice, they argue in an \"ex parte application for order of publication of summons.\" They say they tried reaching his attorneys as well as reaching Teo at the address where he last lived in San Francisco, but they say that not only has Teo since moved to an unknown address, his attorneys claimed to not know his whereabouts and refused to accept the summons on his behalf. \r\n \r\n For his part, Teo last tweeted from his account on December 12. We\'ve reached out to him for more information. \r\n Worth noting: Lai\'s attorneys - who also represented former Uber engineer Susan Fowler after she published her account of sexual harassment and sexism at the company - were able to serve Caldbeck this fall, they say through filings. \r\n \r\n  Caldbeck subsequently agreed to pay Lai $85,000 in exchange for her dismissing litigation against him personally.', 'Served a summons via tweet? It just happened to one allegedly elusive VC', 'economy', 'danielalarconcuesta@gmail.com', 'images/2019/january/bas8rx76a.jpeg'),
('BlIBgyERkI', '2019-01-13 16:57:33', 'As you can well see, the Starship test rocket has a stainless steel skin, which had a few people scratching their heads. Steel is indeed quite durable, but weighs more than other materials used in rockets, like carbon fiber, aluminum and titanium. Musk argues, however, that stainless steelâ€™s resistance to extreme temperature, especially heat, makes it a better fit for this type of rocket.\r\n\r\nThe Starship rocket, previously called the BFR, is an integral piece of the SpaceX  road map. Itâ€™s meant to take the place of the Falcon and Falcon Heavy rockets as a primary launch vehicle, which means lots of re-entry (which means lots of heat).\r\n\r\nThis test model, currently at the Boca Chica, Texas launch site, is meant for suborbital VTOL tests, which will take place in March. The orbital version will be taller, with thicker skins, and a more smoothly curving nose section, with launches on the books for 2020.', 'Elon Musk shows off the assembled Starship test rocket', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/BlIBgyERkI.png'),
('mMFWLvqcMu', '2019-01-13 16:46:07', 'Squareâ€™s  management continues to shuffle. One week after the merchant services and mobile payments company tapped Amrita Ahuja to lead finance, replacing long-time executive Sarah Friar who landed the chief executive role at Nextdoor, the companyâ€™s head of payments, Mary Kay Bowman, has joined Visa as its head of seller solutions.\r\n\r\nThe company will promote someone internally to fill the position, according to a source familiar with the matter.\r\n\r\nBowman joined Square in 2015 after more than a decade at Amazon, most recently as the e-commerce giantâ€™s director of global payments. In her new role, Visa  says Bowman will lead the credit card companyâ€™s â€œstrategy for acceptance products and solutions, driving the design, development and delivery of new services and solutions that will transform the payment experience for both sellers and consumers.â€\r\n\r\nâ€œThis is a critical role, as the point of sale is undergoing dramatic change as it shifts from traditional payment acceptance to digital, cross-channel payment experiences,â€ Visa wrote in a company announcement released Friday morning.', 'Square loses another key executive as Mary Kay Bowman joins Visa', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/mMFWLvqcMu.jpg'),
('oWUqsU0wzt', '2019-01-13 16:36:53', 'Just as on-demand electric scooters are trying to pick up speed in Europe, one of the scooter marketâ€™s most ambitious startups has halted operations in one country after its e-scooters started halting mid-ride, throwing off and injuring passengers.\r\n\r\nLime, the Uber-backed bike and scooter rental company that is reportedly raising money at between a $2 billion and $3 billion valuation, has pulled its full fleet of scooters in Switzerland, in the cities of Basel and Zurich, for safety checks after multiple reports of people injuring themselves after their scooters braked abruptly while in use.\r\n\r\nThe company sent out a notice to users â€” presented in screenshots below, in German, with the full text translated underneath that â€” noting that it is currently investigating whether the malfunction is due to a software fault, where an update of the software causes a scooter inadvertently to reboot during a ride, thus engaging the anti-theft immobilization system.\r\n\r\nTo make up for the disruption in service, itâ€™s offering users a 15-minute credit that they can use when the service is restored, but it doesnâ€™t give an indication of when that might be.\r\n\r\nThe cessation of service comes after reports over the past several months detailed how users have been injured after their Lime scooters stopped abruptly. In November, a doctor broke his elbow after the speedometer on his vehicle failed, the brakes kicked in, and he was thrown into the air. (Fortunately, this happened in front of the hospital, where he also worked.)\r\n\r\nAnother rider dislocated his shoulder after falling over his Lime scooterâ€™s handle bars when travelling at about 25 km/h (about 15 mph). A third suffered cuts and bruises in a similar incident to the other two: abrupt braking while travelling.\r\n\r\nLime launched e-scooter services in several cities across Europe last summer, starting in Paris with aggressive ambitions to expand its business to 25 cities in Europe by the end of 2018.\r\n\r\nIn Switzerland Lime has (had?) about 550 scooters in operation. But overall, Lime hasnâ€™t quite hit its wider regional target. It is currently live in 18 cities in Europe, and not all of those have electric scooters.\r\n\r\nIn the UK, for example, Lime has had a limited roll out of electric bikes and there are no plans at the moment to add scooters.', 'Lime halts scooter service in Switzerland after possible software glitch throws users off mid-ride', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/oWUqsU0wzt.jpg'),
('P00xTDC7G', '2019-01-13 16:48:55', 'Gartner  has released its quarterly PC sales survey for the fourth quarter of 2018, and it was the same old story. PC sales plunged in the fourth quarter and were down 1.3 percent for the year. The three top players â€” HP, Dell and Lenovo â€” accounted for 63 percent of sales worldwide in the quarter.\r\n\r\nThe company found in their preliminary sales research that worldwide sales totaled 68.6 million units in the fourth quarter. That may sound like a big number, but itâ€™s down 4.3 percent over the same period last year.\r\n\r\nGartner principal analyst Mikako Kitagawa said after a couple of quarters of modest growth, the market began to slow down again for a number of reasons, including political and economic uncertainty and a CPU shortage. â€œThere was even uncertainty in the U.S. â€” where the overall economy has been strong â€” among vulnerable buyer groups, such as small and midsize businesses (SMBs). Consumer demand remained weak in the holiday season. Holiday sales are no longer a major factor driving consumer demand for PCs,â€ she said in a statement.\r\n\r\nThat could be because consumers are spending much more time on mobile phones. Many tasks, whether shopping, email, banking or social media, that once required a home PC can easily be done on a mobile phone now, leaving PCs to the realm of business, where it isnâ€™t always practical to do work on a smaller footprint. In fact, Black Friday online shopping totaled $6.1 billion this year, with mobile phones accounting for $2.1 billion.\r\n\r\nThe trade war that has adversely affected Apple and other tech companies probably also had an impact on the PC market.\r\n\r\nLenovo was the biggest winner in the worldwide report, achieving 24.2 percent of market share with number of units sold up 5.9 percent from last year. HP had 22.4 percent market share, but its numbers were down -4.4 percent. Dell came in third with 15.9 percent with market share, up a modest 1.4 percent.', 'Gartner finds PC sales doldrums continued in 2018', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/P00xTDC7G.jpg'),
('pNw02uh1V4', '2019-01-13 16:31:56', 'It was just 5 years ago that there was an ample dose of skepticism from investors about the viability of open source as a business model. The common thesis was that Redhat was a snowflake and that no other open source company would be significant in the software universe.\r\n\r\nFast forward to today and weâ€™ve witnessed the growing excitement in the space: Redhat is being acquired by IBM for $32 billion (3x times its market cap from 2014); Mulesoft was acquired after going public for $6.5 billion; MongoDB is now worth north of $4 billion; Elasticâ€™s IPO now values the company at $6 billion; and, through the merger of Cloudera and Hortonworks, a new company with a market cap north of $4 billion will emerge. In addition, thereâ€™s a growing cohort of impressive OSS companies working their way through the growth stages of their evolution: Confluent, HashiCorp, DataBricks, Kong, Cockroach Labs and many others. Given the relative multiples that Wall Street and private investors are assigning to these open source companies, it seems pretty clear that something special is happening.\r\n\r\nSo, why did this movement that once represented the bleeding edge of software become the hot place to be? There are a number of fundamental changes that have advanced open source businesses and their prospects in the market.\r\n\r\nFrom Open Source to Open Core to SaaS\r\n\r\nThe original open source projects were not really businesses, they were revolutions against the unfair profits that closed-source software companies were reaping. Microsoft,  Oracle, SAP and others were extracting monopoly-like â€œrentsâ€ for software, which the top developers of the time didnâ€™t believe was world class. So, beginning with the most broadly used components of software â€“ operating systems and databases â€“ progressive developers collaborated, often asynchronously, to author great pieces of software. Everyone could not only see the software in the open, but through a loosely-knit governance model, they added, improved and enhanced it.\r\n\r\nThe software was originally created by and for developers, which meant that at first it wasnâ€™t the most user-friendly. But it was performant, robust and flexible. These merits gradually percolated across the software world and, over a decade, Linux became the second most popular OS for servers (next to Windows); MySQL  mirrored that feat by eating away at Oracleâ€™s dominance.\r\n\r\nThe first entrepreneurial ventures attempted to capitalize on this adoption by offering â€œenterprise-gradeâ€ support subscriptions for these software distributions. Redhat emerged the winner in the Linux race and MySQL (thecompany) for databases. These businesses had some obvious limitations â€“ it was harder to monetize software with just support services, but the market size for OSâ€™s and databases was so large that, in spite of more challenged business models, sizeable companies could be built.', 'How open source software took over the world', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/pNw02uh1V4.jpg'),
('Qb3TKaamOt', '2019-01-13 17:07:02', 'A pair of highly-funded gaming unicorns are publicly skirmishing and the deal could have major repercussions for game developers.\r\n\r\nToday, UK-based cloud gaming startup Improbable, announced that Unity, a hugely popular game development engine, had terminated their license, effectively shutting them out from one of their top customer sources. If permanent, the license termination would be a significant blow to Improbable, which enables studios to host large online multiplayer games across multiple servers. The gaming startup has raised more than $600 million from top investors like Softbank, Andreessen Horowitz and Horizons Ventures.\r\n\r\nJust how many Improbable  customers utilize Unity as their game engine of choice through the SpatialOS GDK is unknown, but the two platforms do share some similarities in appeal among small teams looking to innovate. â€œUnity is a popular engine and that popularity extends to the people using our [game development kit],â€ an Improbable spokesperson told TechCrunch. Improbableâ€™s SpatialOS platform also runs on the Unreal Engine and CryEngine and can be designed to work with custom engines.\r\n\r\nSo, howâ€™d this happen?\r\n\r\nThe way Improbable told it this morning, Unity changed their Terms of Service last month and then, without warning, pulled the rug out from under them. Thatâ€™s not how Unity sees it though, the company penned a terse blog post in response, alleging that Improbable was well aware that they were in violation of the ToS.\r\n\r\nâ€œMore than a year ago, we told Improbable in person that they were in violation of our Terms of Service or EULA. Six months ago, we informed Improbable about the violation in writing. Recent actions did not come as a surprise to Improbable; in fact, theyâ€™ve known about this for many months,â€ the post reads.\r\n\r\nUnity developers using SpatialOS spent the day complaining about the move and wondering whether their projects in development would have to be completely reshaped. While the folks at Improbable also seemed unsure about this detail, Unity clarified in its blog post that SpatialOS projects that were live and in production would still be supported.\r\n\r\nUnityâ€™s Terms of Service isnâ€™t exactly the most lucid reading material, but the section in question titled Streaming and Cloud Gaming Restrictions seems to lay out a fairly clear rebuke of what Improbable does.', 'Unity pulls nuclear option on cloud gaming startup Improbable, terminating game engine license', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/Qb3TKaamOt.jpg'),
('R3Pe0JzQiE', '2019-01-13 16:42:22', 'If you watched Netflixâ€™s  latest â€œBlack Mirrorâ€ production, thereâ€™s no doubt it reminded you of the â€œChoose Your Own Adventureâ€ books. Now, the publisher that owns the trademark to â€œChoose Your Own Adventure,â€ Chooseco, LLC, is suing Netflix. The publisher is alleging trademark infringement, The Hollywood Reporter first reported.\r\n\r\nIn the complaint, Chooseco says Netflix â€œused the mark willfully and intentionally to capitalize on viewersâ€™ nostalgia for the original book series from the 1980s and 1990s. The filmâ€™s dark and, at times, disturbing content dilutes the goodwill for and positive associations with Choosecoâ€™s mark and tarnishes its products.â€\r\n\r\nIn one scene, the main character explains to his dad that his video game, â€œBandersnatch,â€ is based on the fictional â€œChoose Your Own Adventureâ€ book.\r\n\r\n20th Century Fox, according to Chooseco, has an options contract to develop a series based on the publisherâ€™s books. Netflix, on the other hand, pursued a license beginning in 2016 but did not receive one, the suit says. Chooseco alleges it also sent Netflix a cease-and-desist letter before the release of â€œBandersnatch.â€\r\n\r\nChooseco is seeking at least $25 million or Netflixâ€™s profits from the film, whichever amount is the greatest, for Netflixâ€™s alleged trademark infringement, false designation of origin, unfair competition and trademark dilution.\r\n\r\nNetflix declined to comment for this story.', 'Netflix faces $25 million lawsuit over â€˜Black Mirror: Bandersnatchâ€™', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/R3Pe0JzQiE.jpg'),
('tcn3RvWsW6', '2019-01-13 17:04:46', 'Samsungâ€™s look-but-donâ€™t-touch policy left many wondering precisely how committed the company is to its new robots. On the other hand, the company was more than happy to let me take the GEMS (Gait Enhancing and Motivation System) out for a spin.\r\n\r\nThe line includes a trio of wearable exoskeletons, the A (ankle), H (hip) and K (knee). Each serve a different set of needs and muscles, but ultimately provide the same functions: walking assistant and resistance for helping wearers improve strength and balance.\r\n\r\nSamsungâ€™s far from the first to tackle the market, of course. There are a number of companies with exoskeleton solutions aimed at walking support/rehabilitation and/or field assistance for physically demanding jobs. ReWalk, Ekso and SuitX have all introduced compelling solutions, and a number of automotive companies have also invested in the space.\r\n\r\nAt this stage, itâ€™s hard to say precisely what Samsung can offer that others canâ€™t, though certainly the companyâ€™s got plenty of money, know-how and super-smart employees. As with the robots, if it truly commits and invests, if could produce some really remarkable work in this space.\r\n\r\nHaving taken the hip system for a bit of a spin in Samsungâ€™s booth, I can at least say that the assistive and resistance modes do work. A rep described the resistance as feeling something akin to walking under water, and Iâ€™m hard-pressed to come up with a better analogy. The assistive mode is a bit hard to pick up on at first, but is much more noticeable when walking up stairs after trying out the other mode.\r\n\r\nLike the robots, itâ€™s hard to know how these products will ultimately fit into the broader portfolio of a company best known for smartphones, TVs and chips. Hopefully we wonâ€™t have to wait until the next CES to find out.', 'Taking a stroll with Samsungâ€™s robotic exoskeleton', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/tcn3RvWsW6.jpg'),
('whpxrWm3', '2017-06-08 14:10:15', 'Yeah hes dead', 'XXXTENTACION', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/whpxrWm3.jpg'),
('zJEowufACI', '2019-01-13 17:00:54', 'Thatâ€™s not the kind of headline one expects to write going into the week. But here we are. Universal Spaceâ€™s analog Pong table is a mindblower in a whole unexpected way. The tabletop machine goes more retro than retro by bringing Pong into the real world through the magic of magnets (some day, perhaps, weâ€™ll discover how they work).\r\n\r\nThereâ€™s a square â€œballâ€ and a pair of rectangular paddles on either side, moved back and forth by spinning a wheel. Like the classic game, spinning faster and hitting corners puts a little English on it, as they say in billiards. Players score by striking the opposite side of the ball. From there, you tap an orange arcade button to fire it back.\r\n\r\nItâ€™s really a thing to behold â€” even more so in single-player mode, where the machine controls the other panel. Youâ€™ve got easy, medium and hard options for that. Iâ€™d start off slow, because thereâ€™s a bit of a noticeable lag that takes some getting used to.\r\n\r\nItâ€™s a neat parlor trick, and one that will almost certainly get party guests excited. Itâ€™ll cost you, though â€” $3,000 to be precise. The arcade model is an additional $1,500. Itâ€™s a lot to pay for what feels like a kind of one-trick pony. Like the original Pong, itâ€™s hard to imagine it holding oneâ€™s attention long enough to justify the price.', 'A Pong table managed to wow CES 2019', NULL, 'danielalarconcuesta@gmail.com', 'images/2019/January/zJEowufACI.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favouritesPosts` mediumtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `password`, `role`, `favouritesPosts`) VALUES
('danielalarconcuesta@gmail.com', 'Daniel', '$5$10$dQiqBn/kI/ikSq/BlM/W/.g8RbuHofLPkXDq3fBdxRA', 'root', 'tcn3RvWsW6,'),
('jack@gmail.com', 'Jack', '$5$10$dQiqBn/kI/ikSq/BlM/W/.g8RbuHofLPkXDq3fBdxRA', 'user', 'BlIBgyERkI,mMFWLvqcMu,R3Pe0JzQiE,'),
('jorge@gmail.com', 'jorge', '$5$10$dQiqBn/kI/ikSq/BlM/W/.g8RbuHofLPkXDq3fBdxRA', 'user', ''),
('mauricio@gmail.com', 'Mauricio', '$5$10$dQiqBn/kI/ikSq/BlM/W/.g8RbuHofLPkXDq3fBdxRA', 'user', ''),
('mikel@gmail.com', 'Mikel', '$5$10$dQiqBn/kI/ikSq/BlM/W/.g8RbuHofLPkXDq3fBdxRA', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `post` (`post`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post`) REFERENCES `posts` (`postId`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`userId`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
